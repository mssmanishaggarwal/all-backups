@extends('layouts.dashboard')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style>


  </style>

@section('script')
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#sortable" ).sortable({
     start : function(event, ui) {
      var start_pos = ui.item.data('order-id');
      $('.alert-success').hide('fast');
      ui.item.data('order-id', start_pos);
    },
    update : function(event, ui) {
     var returnable={};
     var fullArray=[];
     $("#sortable li").each(function() {
      $(this).removeAttr("data-order-id");
      var $index = $(this).index();
      $(this).attr("data-order-id", ($index+1 ) );
      fullArray[$index+1]=$(this).data('row-id');
    });
     returnable.post_variable=fullArray;
     //console.log(returnable);
     $.ajax({
      url: baseUrl+"/dashboard/hall/imageorder",
      data:returnable,
      type: "POST",
      dataType: "application/json",

    }).error(function(err){
      var get=$.parseJSON(err.responseText);
      if(get.status=='success'){
        $('.alert-success').show('fast');
      }
    });
  },
  stop : function(event, ui) {
  },
                        //axis : 'y'
                      });
    //$( "#sortable" ).disableSelection();
  });
$(document).on('click','.cross',function(){
      if(confirm('Do you want to delete this image?')){
      var dal_id=$(this).data('delete-id');
      var image_name=$(this).data('image-name');
      var returna={
        id:dal_id,
        image_name:image_name
      }
      $.ajax({
      url: baseUrl+"/dashboard/hall/delete",
      data:returna,
      type: "POST",
      dataType: "application/json",

    }).error(function(err){
      var get=$.parseJSON(err.responseText);
      if(get.status=='success'){
       // $('.alert-success').show('fast');
        $('.li_del_'+dal_id).remove();
      }
    });
  }
});
$(document).on('click','.post-block',function(){
  var divHtml = $.trim($(this).html() );
    update_id=$(this).data("update_id");
    var editableText = $('<input type="text" class="rex" maxlength="20"/>');
    // o.style.height = (25+o.scrollHeight)+"px";
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();
});
$(document).on('blur','input.rex',function() {
    var html = $.trim($(this).val() );
    var viewableText = $("<div class='post-block' data-update_id='"+update_id+"'>");
    viewableText.html(html);
    $(this).replaceWith(viewableText);
          var param={};
       param={'update_id':update_id,
              'content':html
            };
      /* if ($.trim($(this).val())) {*/
              $.ajax({
                  url: baseUrl+"/dashboard/hall/caption-image",
                  data:param,
                  type: "POST",
                  dataType: "application/json",

              })

       /* }else{
              alert('You can not leave this Blank.');
            location.reload();

        }*/
    });

/*================Multiimage Uploader start=======================*/


$(document).on('change','.image-uploader',function(){

      var image = baseUrl+'/public/images/site/img-loader.gif';
      $('.loader > center').html("<img src='"+image+"' />");
      var formData = new FormData();
      var img = new Image();

      jQuery.each(jQuery('.image-uploader')[0].files, function(i, file) {
        switch(file.type){
          case 'image/jpeg': case 'image/gif': case 'image/jpg': case 'image/png':
          formData.append('images[]', file);
          break;
        default:
          $('.loader > center').html('');
          alert("Hall picture accept a .jpeg/.gif/.jpg/.png file only.");
          break;
        }


      });
      setTimeout(function(){ call_the_ajax() }, 1000);

 function call_the_ajax(){
       // reader.readAsDataURL(input.files[0]);
      $.ajax(baseUrl+'/dashboard/hall/multipleimage', {
          method: 'POST',
          contentType: false,
          processData: false,
          data: formData
      }).then(function success(userInfo) {
          var get=$.parseJSON(userInfo);
          if(get.success=='Uploaded Successfully.'){
              bring_all_images();
          }
       });
      }
  function bring_all_images(){
      $.ajax({
              url:baseUrl+"/dashboard/hall/appending-images",
              type: "POST",
              data:{
                image_order:$('#sortable li:last-child').data('order-id'),
              },
              success: function(result) {
             $('.loader > center >img').remove();
               for(var key in result){ //console.log(result[key].hall_id);
                  $('#sortable').append('<li class="ui-state-default handle li_del_'+result[key].id+' ui-sortable-handle" data-order-id="'+result[key].image_order+'" data-row-id="'+result[key].id+'" data-count="1"><div class="wrap-container"><span class="cross" data-delete-id="'+result[key].id+'" data-image-name="'+result[key].hall_image+'">x</span><img src="'+baseUrl+'/public/uploads/hall/'+result[key].hall_image+'" height="125" width="125"></div><div class="post-block" data-update_id="'+result[key].id+'">Enter Caption</div></li>');
                }
           }
       }).error(function(re){



       });

  }

    })
$(document).on('click','.upls',function(){
  $('.image-uploader').trigger('click');
});





/*================Uultiimage Uploader ended=======================*/
</script>
<style type="text/css">
  .loading-image {
    width:100%;
    height:100%;
    z-index:1000;
}
.loader
{
    /*display: none;*/
    width:200px;
    height: 200px;
    /*position: fixed;*/
    top: 50%;
    left: 50%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
    overflow: auto;

}
.image-uploader{
  display: none !important;
}
</style>
@endsection
@section('content')
<style type="text/css">
    input[type=checkbox]+ span{
        border:1px solid black;
    }
</style>
<section class="dash-main clearfix">
<div class="col-md-12 dash-top-second">
	<div class="col-md-9 p-l-none">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_179')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
    <li><a href="{{url('dashboard/my-hall')}}">My Hall</a></li>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_180')}}</li>
	</ul>
	</div>
</div>
<div class="col-md-12 dash-container p-t-20 p-b-20 hallformwrap">
<div class="alert alert-success orange" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>{{ Sitevariable::setVariables($data['language_val'],'eventus_181')}}.</strong>
</div>

  <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" ><a href="{{url('/dashboard/add-my-hall')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</a></li>
    <li role="presentation" class="active"><a href="{{url('/dashboard/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</a></li>
    <li role="presentation"><a href="{{url('/dashboard/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_137')}}</a></li>
    <li role="presentation"><a href="{{url('/dashboard/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</a></li>
     <li role="presentation" ><a href="{{url('/dashboard/hall/calender/')}}" ><span class="fa fa-calendar"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/subscription/')}}" ><span class="fa fa-cube"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</a></li>
  </ul>
<div class="tab-content">
<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</h5>
    <!-- <form class="form-horizontal hallform clearfix" role="form" method="POST" action="{{ url('/dashboard/hall/multipleimage/') }}" enctype="multipart/form-data" accept-charset="UTF-8"> -->


                {!! csrf_field() !!}
                 {!! Form::file('images[]', array('multiple'=>true,'class'=>'image-uploader')) !!}
                 <input type="submit" class="orange button-name upls" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_184')}}"  />
                 <p>{{ Sitevariable::setVariables($data['language_val'],'eventus_182')}}.</p>
                 <p>{{ Sitevariable::setVariables($data['language_val'],'eventus_183')}}.</p>

<ul id="sortable" class="ui-sortable clearfix photo-wrapper">
	<?php if (array_key_exists('fetched_images', $data)) {
	$count = 1;
	foreach ($data['fetched_images'] as $images) {
		?>
			<li class="ui-state-default handle li_del_<?php echo $images->id; ?>"
			data-order-id="<?php echo $images->image_order; ?>"
			data-row-id="<?php echo $images->id; ?>"
			data-count="<?php echo $count; ?>">
      <div class="wrap-container">
          <span class="cross" data-delete-id="<?php echo $images->id; ?>" data-image-name="<?php echo $images->hall_image; ?>">x</span>
			   <img src="{{url('/public/uploads/hall')}}/<?php echo $images->hall_image; ?>" height="125" width="125">
      </div>
     <div class="post-block" data-update_id="<?php echo $images->id; ?>">
     <?php if ($images->hall_image_caption == '') {
			echo 'Enter Caption';
		} else {
			echo $images->hall_image_caption;
		}?>
     </div>
		</li>
		<?php
$count++;
	}
}?>

</ul>
<div class="loader">
   <center>

   </center>
</div>

       <div class="col-md-12 m-b-35 m-t-15">
       <!--  <input type="submit" class="orange button-name" value="Upload"  /> -->
        @if (session('status'))
<div class="alert alert-success orange">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>{{ session('status') }}</strong>
</div>
@endif
@if (session('fails'))
<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>{{ session('fails') }}</strong>
</div>
@endif
       </div>
<!--     </form> -->

</div>

</div>


</section>

@endsection