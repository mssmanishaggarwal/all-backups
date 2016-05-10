@extends('layouts.backend')

@section('content')
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">
var baseUrl = $('#baseUrl').val();
  var subscription_price=0;
  var feature_price=0;
  var grand_total=0;
$(document).on('change','input[name=subscription]',function(){ //alert();
  subscription_price=0;
  grand_total=0;
  subscription_price=$('input[name=subscription]:checked').data('subscription-price');

  grand_total=grand_total+subscription_price;
  $('.tot-price').html(grand_total);
  
  $('#sub_start_date').addClass('required');


});
$(document).on('click',"input[name='featured[]']", function(){
  $("input[name='featured[]']:checked").each(function (){
    feature_price=parseFloat($(this).data('featured-price'));
    grand_total=grand_total+feature_price;
    $('.tot-price').html(grand_total);
  });
  $("input[name='featured[]']:not(:checked)").each(function (){
    feature_price=parseFloat($(this).data('featured-price'));
    grand_total=grand_total-feature_price;
    $('.tot-price').html(grand_total);
  });
	
	 $('#fet_start_date').addClass('required');
});
$(document).on('submit','.paynow',function(em){
  em.preventDefault();
  if(subscription_price || feature_price){
  $('.paynow').validate({
		errorPlacement: function(){
        return false;
    		},
   submitHandler:function(){
  
    $('.tab-content').addClass('mydiv');
    $('.ajax-loader').show();
    $.ajax({
      url: baseUrl+"/admin/hall_subscription_payment/{{$data['hall_id']}}",
      data:{
        subscription_price:$('input[name=subscription]:checked').data('subscription-price'),
        subscription_name:$('input[name=subscription]:checked').data('subscription-name'),
        subscription_month:$('input[name=subscription]:checked').data('subscription-month'),
        subscription_id:$('input[name=subscription]:checked').val(),
        subscription_start_date:$('#sub_start_date').val(),
        featured_price:$("input[name='featured[]']:checked").data('featured-price'),
        featured_name:$("input[name='featured[]']:checked").data('featured-name'),
        featured_month:$("input[name='featured[]']:checked").data('featured-month'),
        featured_id:$("input[name='featured[]']:checked").val(),
        featured_start_date:$('#fet_start_date').val(),
        transaction_id:$('#transaction_id').val(),
        grand_total:grand_total,
      },
      type: "POST",
      dataType: "application/json",
      accept: "application/json",
    }).complete(function(res){
    	//console.log(res);
       var get=$.parseJSON(res.responseText);//console.log(get.hall_id);
  		window.location.href=baseUrl+'/admin/hall_subscription/'+get.hall_id;
    }).error(function(err){
    });
  },
  });
  }else{
    alert('Please select atleast one Subscription or Featured Service.');
  }
  

});
</script>

<div id="main" style="display: block !important;">

  <form id="master-file-form" novalidate="novalidate" class="form-horizontal paynow">


    <!-- Nav tabs -->
    <ul class="nav nav-tabs custom-tab" role="tablist">
      <li role="presentation" ><a href="{{url('/admin/hall')}}/{{$data['hall_id']}}" ><span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
      <li role="presentation" ><a href="{{url('/admin/hall_uploadimage/')}}/{{$data['hall_id']}}" ><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
      <li role="presentation" ><a href="{{url('/admin/hall_addon/')}}/{{$data['hall_id']}}"><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
      <li role="presentation" ><a href="{{url('/admin/hall_accommodation/')}}/{{$data['hall_id']}}" ><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
      <li role="presentation" class="active"><a href="{{url('/admin/hall_subscription/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Subscription</a></li>
      <li role="presentation" ><a href="{{url('/admin/hall_calender/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Calender</a></li>
    </ul>


<?php //echo $data['subscription_last_date']; ?>


    <div class="box box-warning">
     <div class="tab-content" data-page="{{$data['hall_id']}}">
      <div role="tabpanel" class="tab-pane active" id="hallDetails">
        <div class="box-header with-border">
        @foreach($data['subscription_notification'] as $notify)
      <div class="col-md-6 col-sm-6 col-xs-6 yellow-border m-b-20">
        <h5>Your Subscription</h5>
        <ul class="sub-notify">
          <li>Name : {{ $notify->subscription_name}}.</li>
          <li>Duration : {{ $notify->subscription_month}} months.</li>
          <li>Payment date : {{date("d/m/Y", strtotime($notify->start_date)) }}.</li>
          <li>Expiry date : {{date("d/m/Y", strtotime($notify->expiry_date)) }}.</li>
        </ul>
      </div>
      @endforeach
      @foreach($data['feature_notification'] as $notify)
      <div class="col-md-6 col-sm-6 col-xs-6 green-border m-b-20">
        <h5>Your Featured Service</h5>
        <ul class="sub-notify">
          <li>Name : {{ $notify->feature_name}}.</li>
          <li>Duration : {{ $notify->feature_month}} months.</li>
          <li>Payment date : {{dateFormat($notify->start_date) }}.</li>
          <li>Expiry date : {{dateFormat($notify->expiry_date) }}.</li>
        </ul>
      </div>
      @endforeach
      
      <div style="clear:both;"></div>
          <h3 class="box-title"> Subscription</h3>
        </div>
        <div class="box-body">
        @if(subscriptionAvailability($data['hall_id']) <= 30)
         <h5>Subscription</h5>
         @foreach($data['subscription'] as $val)
         <div class="col-md-4 col-sm-6 col-xs-6 x-type p-r-none p-l-none">
          <div class="form-group">
            <div class="col-sm-7 col-xs-7 p-r-none p-l-none">
              <div class="checkbox"><label>
                <input type="radio" class="subscription"  name="subscription" id="sub_id_{{$val->id}}" value="{{$val->id}}" data-subscription-price="{{$val->subscription_price}}" data-subscription-name="{{$val->subscription_name}}"
                data-subscription-month="{{$val->subscription_month}}">{{$val->subscription_name}}</label></div>
              </div>
              <div class="col-sm-5 col-xs-5 text-left subsc-price">
                {{$val->subscription_price}} AOA
              </div>
            </div>

          </div>
          @endforeach
           <div class="clearfix"></div>
          <div class="form-group">
                   <label class="col-sm-2 text-right"> Subscription Start Date <span class="text-red">*</span></label>
                    <div class="col-sm-4"> <input type="text" class="form-control" name="sub_start_date" id="sub_start_date" value="" /></div>
                </div>
          @endif      
          <div class="clearfix"></div>
          <h5>Featured Service</h5>

          @foreach($data['featured'] as $val)
          <div class="col-md-12 col-sm-12 col-xs-12 x-type p-r-none">
            <div class="col-md-12 col-sm-12 col-xs-12 x-type p-r-none p-l-none">
              <div class="form-group">
                <div class="col-sm-6 col-xs-7 p-r-none p-l-none">
                  <div class="checkbox"><label><input type="checkbox" class="featured"  name="featured[]" id="hall_id_{{$val->id}}" value="{{$val->id}}" data-featured-price="{{$val->featured_price}}" data-featured-name="{{$val->featured_name}}"
                    data-featured-month="{{$val->featured_month}}">{{$val->featured_name}}  {{$val->featured_price}} AOA</label></div>
                  </div>

                </div>

              </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
            <div class="form-group">
                   <label class="col-sm-2 text-right"> Feature Start Date <span class="text-red">*</span></label>
                    <div class="col-sm-4"> <input type="text" class="form-control" name="fet_start_date" id="fet_start_date" value="" /></div>
            </div>


            <h5>Total Price</h5>
            <div class="col-md-12 col-sm-12 col-xs-12 x-type p-r-none p-l-none">
              <span class="tot-price">0.00</span> <span> AOA</span>
            </div>
            <p>&nbsp;</p>
            
            <div class="form-group">
                    <label class="col-sm-2 text-left">Transaction ID / Reference ID <span class="text-red"></span></label>
                    <div class="col-sm-4"><input type="text" class="form-control" name="transaction_id" id="transaction_id" value="" >
                </div>
             </div>
          </div>
          <div class="box-footer text-right">           
        <span class="alert alert-success alert-sm save_msg" style="display: none;">{{ trans('messages.saved') }}</span>

          <button type="submit" class="btn btn-primary" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $data['saveBtn'] }}</button>
          <button type="button" class="btn btn-default" id="cloneButton" onclick="document.location.href='{{ url('/admin/hall_list') }}'"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
          <p> <div id="error_msg"></div></p>
        </div>

      </div>
    </form>
  </div>
  @endsection
  @section('script')
  
  <script type="text/javascript">


 $(function() { 
 var dateToday = new Date();
 if('<?php echo $data['subscription_last_date']?>' == '')	
 var subMindate = dateToday;
 else
 	subMindate = '<?php echo $data['subscription_last_date']; ?>';
    $( "#sub_start_date" ).datepicker({      
      dateFormat: "yy-mm-dd",
      minDate:subMindate
    });
    $( "#fet_start_date" ).datepicker({      
      dateFormat: "yy-mm-dd",
      minDate:dateToday
    });
  });

</script>
  {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
  @endsection