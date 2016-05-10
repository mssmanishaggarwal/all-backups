@extends('layouts.backend')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style type="text/css">
    input[type=checkbox]+ span{
        border:1px solid black;
    }
    .image-uploader{
      display: none;
    }
    .photo-wrapper {
    padding: 15px 0;
}
.photo-wrapper li {
    margin: 0 5px 5px 0;
    padding: 5px;
    float: left;
    width: 19%;
    height: auto;
    font-size: 15px;
    text-align: center;
    cursor: move;
    position: relative;
    min-height: 175px;
    transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
}
.post-block {
    font-size: 15px;
    cursor: pointer;
    margin: 5px 0;
}
.wrap-container > .cross, .favourite > .cross {
    background: #e42f11;
    border-radius: 50%;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 22px;
    height: 30px;
    line-height: 25px;
    position: absolute;
    right: 2px;
    top: 2px;
    width: 30px;
    z-index: 901;
    text-align: center;
}
/*.photo-wrapper li .wrap-container img {
    width: 100%;
}*/
ul, li {
    list-style: none;
}
.wrap-container > img{
  height: 126px !important;
}
  .loading-image {
    width:100%;
    height:100%;
    z-index:1000;
}
/*.loader
{

    width:200px;
    height: 200px;

    top: 50%;
    left: 50%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
    overflow: auto;

}*/
.photo-wrapper{ padding:15px 0;}
.photo-wrapper li { margin: 0 5px 5px 0; padding: 5px; float: left; width:19%; height:auto; font-size: 15px; text-align: center; cursor:move; position:relative; min-height:175px; transition:all 0.3s ease; -moz-transition:all 0.3s ease; -webkit-transition:all 0.3s ease; }
.photo-wrapper li .wrap-container img{ width:100%;}
.post-block{font-size: 15px; cursor: pointer; margin:5px 0;}
.rex{width:100%; padding:4px; margin:5px 0 0 0; }
</style>
<section class="dash-main clearfix">
<div class="col-md-12 dash-container p-t-20 p-b-20 hallformwrap">
<div class="alert alert-success orange" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Images are sorted in order correctly.</strong>
</div>
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

 <div id="main" style="display: block !important;">


<?php
if ($data['hall_id'] != '') {
	$saveBtn = 'Save';
}
?>


	{!! Form::open(array('url'=>'/admin/hall_multipleimage/'.$data['hall_id'],'method'=>'POST', 'files'=>true)) !!}


  <!-- Nav tabs -->
 <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" ><a href="{{url('/admin/hall')}}/{{$data['hall_id']}}" > <span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
    <li role="presentation" class="active"><a href="{{url('/admin/hall_uploadimage/')}}/{{$data['hall_id']}}" aria-controls="profile" role="tab" data-toggle="tab"><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
    <li role="presentation"><a href="{{url('/admin/hall_addon/')}}/{{$data['hall_id']}}" ><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall_accommodation/')}}/{{$data['hall_id']}}" ><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall_subscription/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Subscription</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall_calender/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Calender</a></li>
  </ul>


                 <div class="box box-warning">
                   <div class="tab-content" data-page="{{$data['hall_id']}}">


    <div role="tabpanel" class="tab-pane active" id="hallDetails">
                    <div class="box-header with-border">
                                      <h3 class="box-title">Upload Photos
                                    </h3>

                                    </div>


                   <div class="box-body" >
<!-- ==============File Upload======================== -->
<div class="text-content">
    <div class="control-group">
     <div class="cotrol-label"><strong class="secure"> Upload Images </strong></div> <div class="controls">
      {!! Form::file('images[]', array('multiple'=>true,'class'=>'image-uploader')) !!}
    <p class="errors">{!!$errors->first('images')!!}</p>
<ul class="text-muted list-inline"><li>Only upload .jpeg/.png/.jpg images, </li>
<li>File Size should not be exceed 2MB space,</li><li> preferable size is 300 X 240px,</li>
<li>You can select multiple image by pressing Ctrl.</li></ul>
     </div>
     </div>

     <input type="hidden" name="page_id" value="{{$data['hall_id']}}">
     <div class="image_container row" >
     </div>
</div>

<ul id="sortable" class="ui-sortable clearfix photo-wrapper">
	<?php if (array_key_exists('hallimages', $data)) {
	$count = 1;
	foreach ($data['hallimages'] as $images) {
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
   <div>

   </div>
</div>





</div>

<!-- ==============File Upload Ended==================== -->


                </div>


               </div>
                <div class="box-footer text-right"> <span class="spinner-loader pull-left" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span>
               <span class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </span><span class="alert alert-success alert-sm pull-left save_msg" style="display: none;">{{ trans('messages.saved') }}</span>
                           <!--   <span class="text-muted" style="color:red !important;"> After Uploading Photo, please click on Save button</span> &nbsp;&nbsp;-->

                          <!--   <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $data['saveBtn'] }}</button> -->
                          <!--   <button type="button" data-bind="click: cancel" class="btn btn-default" id="cloneButton cancel-btn"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button> -->
                    <p> <div id="error_msg"></div></p>
                  </div>
                  </div>

          {!! Form::close() !!}

        </div>


@endsection
@section('script')
<script>

  $(function() {
   var baseUrl = $('#baseUrl').val();
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

     $.ajax({
      url: baseUrl+"/admin/hall_imageorder",
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
	  var baseUrl = $('#baseUrl').val();
      if(confirm('Do you want to delete this image?')){
      var dal_id=$(this).data('delete-id');
       var image_name=$(this).data('image-name');
      var returna={
        id:dal_id,
        image_name:image_name
      }
	   //console.log(baseUrl);
      $.ajax({
      url: baseUrl+"/admin/hall_deleteimages",
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
	var baseUrl = $('#baseUrl').val();
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
                  url: baseUrl+"/admin/hall_caption-image",
                  data:param,
                  type: "POST",
                  dataType: "application/json",

              })

       /* }else{
              alert('You can not leave this Blank.');
            location.reload();

        }*/
});
$(document).on('change','.image-uploader',function(){
  var baseUrl = $('#baseUrl').val();

      var image = baseUrl+'/public/images/site/img-loader.gif';
      $('.loader > div').html("<img src='"+image+"' />");
      var formData = new FormData();
      var img = new Image();

      jQuery.each(jQuery('.image-uploader')[0].files, function(i, file) {
        switch(file.type){
          case 'image/jpeg': case 'image/gif': case 'image/jpg': case 'image/png':
          formData.append('images[]', file);
          break;
        default:
          alert("Hall picture accept a .jpeg/.gif/.jpg/.png file only.");
          break;
        }


      });
      setTimeout(function(){ call_the_ajax() }, 1000);

 function call_the_ajax(){
       // reader.readAsDataURL(input.files[0]);
      $.ajax(baseUrl+"/admin/hall_multipleimage/{{$data['hall_id']}}", {
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
              url:baseUrl+"/admin/hall_appendingimages/{{$data['hall_id']}}",
              type: "POST",
              data:{
                image_order:$('#sortable li:last-child').data('order-id'),
              },
              success: function(result) {
             $('.loader > div >img').remove();
               for(var key in result){ //console.log(result[key].hall_id);
                  $('#sortable').append('<li class="ui-state-default handle li_del_'+result[key].id+' ui-sortable-handle" data-order-id="'+result[key].image_order+'" data-row-id="'+result[key].id+'" data-count="1"><div class="wrap-container"><span class="cross" data-delete-id="'+result[key].id+'" data-image-name="'+result[key].hall_image+'">x</span><img src="'+baseUrl+'/public/uploads/hall/'+result[key].hall_image+'" height="125" width="125"></div><div class="post-block" data-update_id="'+result[key].id+'">Enter Caption</div></li>');
                }
           }
       }).error(function(re){



       });

  }

});
$(document).on('click','.upls',function(){
  $('.image-uploader').trigger('click');
});
</script>
{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}

@endsection