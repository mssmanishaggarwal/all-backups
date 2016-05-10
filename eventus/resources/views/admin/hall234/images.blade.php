@extends('layouts.backend')

@section('content')


 <div id="main" style="display: block !important;">


<?php
if ($page_id != '') {
	$saveBtn = 'Save';
}
?>


 {!! Form::open(array('url'=>'/admin/hall/multipleimage/','method'=>'POST', 'files'=>true)) !!}


  <!-- Nav tabs -->
 <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" ><a href="{{url('/admin/hall')}}/{{$page_id}}" > <span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
    <li role="presentation" class="active"><a href="{{url('/admin/hall/uploadimage/')}}/{{$page_id}}" aria-controls="profile" role="tab" data-toggle="tab"><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/set-location')}}/{{$page_id}}" class="disable_link"><span class="fa fa-map"></span> Set Location</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/addon/')}}/{{$page_id}}" ><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall/accommodation/')}}/{{$page_id}}" ><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall/subscription/')}}/{{$page_id}}" ><span class="fa fa-cube"></span> Subscription</a></li>
  </ul>


                 <div class="box box-warning">
                   <div class="tab-content" data-page="{{$page_id}}">


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
      {!! Form::file('images[]', array('multiple'=>true)) !!}
    <p class="errors">{!!$errors->first('images')!!}</p>
<ul class="text-muted list-inline"><li>Only upload .jpeg/.png/.jpg images, </li>
<li>File Size should not be exceed 2MB space,</li><li> preferable size is 300 X 240px,</li>
<li>You can select multiple image by pressing Ctrl.</li></ul>
     </div>
     </div>

     <input type="hidden" name="page_id" value="{{$page_id}}">
     <div class="image_container row" >
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
                             <span class="text-muted" style="color:red !important;"> After Uploading Photo, please click on Save button</span>&nbsp;&nbsp;

                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $saveBtn }}</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default" id="cloneButton cancel-btn"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>
                  </div>

          {!! Form::close() !!}

        </div>






@endsection
@section('script')

{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
{{ Html::script('public/js/multiimage/knockout-file-bindings.js') }}
{{ Html::script('public/js/add_hall_iamges.js') }}
@endsection