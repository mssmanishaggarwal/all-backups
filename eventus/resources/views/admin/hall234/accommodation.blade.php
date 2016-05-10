@extends('layouts.backend')

@section('content')


 <div id="main" style="display: block !important;">

<?php
if ($page_id != '') {
	$saveBtn = 'Save';
}
?>



            <form id="master-file-form" novalidate="novalidate" class="form-horizontal">


  <!-- Nav tabs -->
 <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" ><a href="{{url('/admin/hall')}}/{{$page_id}}" ><span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall/uploadimage/')}}/{{$page_id}}" ><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/set-location')}}/{{$page_id}}" class="disable_link"><span class="fa fa-map"></span> Set Location</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall/addon/')}}/{{$page_id}}" ><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
    <li role="presentation" class="active"><a href="{{url('/admin/hall/accommodation/')}}/{{$page_id}}" aria-controls="settings" role="tab" data-toggle="tab"><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
     <li role="presentation" ><a href="{{url('/admin/hall/subscription/')}}/{{$page_id}}" ><span class="fa fa-cube"></span> Subscription</a></li>
  </ul>


                 <div class="box box-warning">
                   <div class="tab-content" data-page="{{$page_id}}">
                    <div role="tabpanel" class="tab-pane active" id="hallDetails">
                    <div class="box-header with-border">
                                      <h3 class="box-title">Accommodation
                                    </h3>

                                    </div>


                   <div class="box-body">







                </div>
                 <div class="box-footer text-right"><span class="spinner-loader pull-left" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span>
                 <span class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </span><span class="alert alert-success alert-sm save_msg" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $saveBtn }}</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>


               </div>






            </form>

        </div>






@endsection
@section('script')

{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}

{{ Html::script('public/js/add_hall_accommodation.js') }}
@endsection