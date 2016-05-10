@extends('layouts.backend')
@section('content')
 <div id="main" style="display: block !important;">
<?php
if ($data['hall_id'] != '') {
	$saveBtn = 'Save';
}
?>  <form id="master-file-form" novalidate="novalidate" class="form-horizontal">
  <!-- Nav tabs -->
 <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" ><a href="{{url('/admin/hall')}}/{{$data['hall_id']}}" ><span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall_uploadimage/')}}/{{$data['hall_id']}}" ><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
    <li role="presentation" class="active"><a href="{{url('/admin/hall_addon/')}}/{{$data['hall_id']}}" aria-controls="messages" role="tab" data-toggle="tab"><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall_accommodation/')}}/{{$data['hall_id']}}" ><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall_subscription/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Subscription</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall_calender/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Calender</a></li>
 </ul>
                 <div class="box box-warning">
                   <div class="tab-content" data-page="{{$data['hall_id']}}">
                    <div role="tabpanel" class="tab-pane active" id="hallDetails">
                    <div class="box-header with-border">
                        <h3 class="box-title">Addon Service</h3>
                    </div>
                   <div class="box-body">
                   </div>
                 <div class="box-footer text-right">                
                            <span class="alert alert-success alert-sm save_msg pull-left" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $data['saveBtn'] }}</button>
                            <button type="button" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>
               </div>
            </form>
        </div>
@endsection
@section('script')
<script>
$( window ).load(function() {
 var baseUrl = $('#baseUrl').val();
 var page_id=$('.tab-content').data('page');
 $.ajax({
  url: baseUrl+"/admin/hall_selectaddon",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
   $('.box-body').html('<div class="form-group"><label class="col-sm-2 text-left"><span class="fa  fa-check-square-o"></span> <b>Name</b></label><div class="col-sm-2 text-right"><label>Price</label><span class="text-muted"> (AOA)</span></div></div>');
   for(var key in result){
      //console.log(result[key]);
      $('.box-body').append('<div class="form-group"><div class="col-sm-2"> <div class="checkbox"><label><input type="checkbox" class=""  name="addon_id[]" id="hall_id_'+result[key].addon_id+'" value="'+result[key].id+'"> '+result[key].addon_name+'</label></div></div><div class="col-sm-2 text-right"><input id="addon_price_id_'+result[key].addon_id+'" type="test" name="addon_price[]" class="form-control text-right" value=""/></div></div>');
     
     }checker();
    }
  });

}); 

function checker(){
 var baseUrl = $('#baseUrl').val();
 var page_id=$('.tab-content').data('page'); 
 $.ajax({
  url: baseUrl+"/admin/hall_addonchecker",
  data:{hall_id:page_id},
  type: "POST",
  dataType: "application/json",
  accept: "application/json",
 }).done(function(res){
  console.log(res);
 }).error(function(err){
  var get=$.parseJSON(err.responseText);
  for(var key in get){
   $('#hall_id_'+get[key].addon_id).attr('checked', 'checked');
   $('#addon_price_id_'+get[key].addon_id).val(parseInt(get[key].addon_price));
  }
 });
}


/*setTimeout(function() {*/
 
/*}, 18);*/


/*$( window ).load(function() {
 
});*/

$(document).on('submit', '#master-file-form', function(event) {
 event.preventDefault();
 var baseUrl = $('#baseUrl').val();
 var hall_id=$('.tab-content').data('page');
 var addon_ids = [];
 var addon_prices = [];
 var flag = 0;
 $("input[name='addon_id[]']:checked").each(function ()
 {
  addon_ids.push(parseInt($(this).val()));
  addon_prices.push(parseInt($('#addon_price_id_'+$(this).val()).val()));
  $('#addon_price_id_'+$(this).val()).removeClass('error_pass');
  if( $('#addon_price_id_'+$(this).val()).val() == '' ) {
  	$('#addon_price_id_'+$(this).val()).addClass('error_pass');
  	flag = 1;
  }
 }); 
 if( flag == 0 ) {
	 $.ajax({
	  url: baseUrl+"/admin/hall_insrtaddon",
	  data:{hall_id:hall_id,addon_id:addon_ids,addon_price:addon_prices},
	  type: "POST",
	  dataType: "application/json",
	       
	}).error(function(err){
	  var get=$.parseJSON(err.responseText);//console.log(get.hall_id);
	  window.location.href=baseUrl+'/admin/hall_addon/'+get.hall_id;
	 });
}
 
});

jQuery(document).ready(function($) {
   
 $('.btn-default').click(function(){ 
      var baseUrl = $('#baseUrl').val();
     window.location.href = baseUrl+'/admin/hall_list';
});   
});

</script>
{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection