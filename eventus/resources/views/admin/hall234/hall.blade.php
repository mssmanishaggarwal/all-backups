@extends('layouts.backend')

@section('content')


 <div id="main" style="display: block !important;">





            <form id="master-file-form" novalidate="novalidate" class="form-horizontal">

                <?php
if ($page_id != '') {
	?>

  <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" class="active"><a href="hall" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/uploadimage')}}/{{$page_id}}" class="disable_link"><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/set-location')}}/{{$page_id}}" class="disable_link"><span class="fa fa-map"></span> Set Location</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/addon')}}/{{$page_id}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/accommodation')}}/{{$page_id}}" class="disable_link"><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall/subscription/')}}/{{$page_id}}" ><span class="fa fa-cube"></span> Subscription</a></li>
  </ul>
<?php
} else {
	?>
  <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" class="active"><a href="hall" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/set-location')}}" class="disable_link"><span class="fa fa-map"></span> Set Location</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span> Add Addon</a></li>
    <li role="presentation"><a href="{{url('/admin/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
    <li role="presentation" ><a href="{{url('/admin/hall/subscription/')}}/{{$page_id}}" ><span class="fa fa-cube"></span> Subscription</a></li>
  </ul>
<?php }
?>
                 <div class="box box-warning">
                   <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="hallDetails">
                    <div class="box-header with-border">
                                      <h3 class="box-title">Add Hall Details
                                    </h3>

                                    </div>


                   <div class="box-body">


                <!-- ko if: hallList().length > 0 -->
                    <!-- ko foreach: hallList() -->


                 <input type="hidden" name="user_id" data-bind="value: user_id" id="user_id">




                    <div class="form-group">
                        <label class="col-sm-2 text-right">Hall Name <span class="text-red">*</span></label>
                        <div class="col-sm-4"><input type='text' required="required" class="form-control" data-bind="value: hall_name" name="hall_name" id="hall_name" /></div>
                    </div>
                    <div class="form-group">
                         <label class="col-sm-2 text-right">Hall Type <span class="text-red">*</span></label>
                   <div class="col-sm-10">
                   <!-- ko foreach: hall_type() -->
                   <div class="checkbox-inline no-top-padding">
                   <label for="checkbox">
    <input type="checkbox" name="hall_type[]" id="hall_type" data-bind="value: hall_type_id" /><span data-bind="text:hall_type_name"></span></label></div>
                    <!-- /ko  -->
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Description <span class="text-red">*</span></label>
                        <div class="col-sm-4"><textarea name="hall_description" data-bind="value: hall_description" id="hall_description" class="form-control" rows="5" cols="150" required="required"> </textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Address<span class="text-red">*</span></label>
                        <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: hall_address" name="hall_address" id="hall_address" /></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Location<span class="text-red">*</span></label>
                        <div class="col-sm-4">  <select class="form-control" id="location_id" required="required" name="location_id"
                                data-bind="value: location_id,
                                options: myOptions,
                                optionsText: 'location_name',
                                optionsValue: 'location_id',
                                optionsCaption: 'Select'">
                            </select> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Province<span class="text-red">*</span></label>
                        <div class="col-sm-4">
                        <select class="form-control" id="hall_province" required="required" name="hall_province"
                                data-bind="value: hall_province,
                                options: provinceOptions,
                                optionsText: 'province_name',
                                optionsValue: 'id',
                                optionsCaption: 'Select Province'">
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Post Code<span class="text-red"></span></label>
                        <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: hall_postcode" name="hall_postcode" id="hall_postcode" /> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Amount<span class="text-red">*</span></label>
                        <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: rental_amount" name="rental_amount" required="required" id="rental_amount" /></div>  <div class="col-sm-2 no-padding"><span class="text-aoa">AOA</span></div>
                    </div>


                 <div class="form-group">
                                    <label class="col-sm-2 text-right">Official Name <span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: official_name" name="official_name" id="official_name" required="required"/>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 text-right">Contact Name <span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: contact_name" name="contact_name" id="contact_name" required="required"/>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 text-right">Contact Email<span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: contact_email" name="contact_email" id="contact_email" required="required"/>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 text-right">Contact Mobile <span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: contact_mobile" name="contact_mobile" id="contact_mobile" required="required"/>
                                </div>
                                </div>
                                <div class="form-group"  data-bind="visible : $index() == ($parent.hallList().length-1)">
                     <label class="col-sm-2 text-right"> Is Active</label>
                     <div class="col-sm-4"><div data-bind="if: is_active == 1 ">
                        <input type="checkbox" class="" name="is_active" id="is_active" checked="checked" />
                    </div>
                    <div data-bind="if: is_active == 0 ">
                        <input type="checkbox" class="" name="is_active" id="is_active" />
                    </div>
                    </div>
                </div>

                      <!-- /ko -->
                   <!-- /ko -->

                   <!-- ko if: hallList().length <= 0 -->
                    <div class="form-group">
               <label class="col-sm-2 text-right">Select User <span class="text-red">*</span></label>
                 <div class="col-sm-4">
                 <select class="form-control" required="required" name="user_id" id="user_id"
                                data-bind="value: user_id,
                                options: fetch_user,
                                optionsText: 'email',
                                optionsValue: 'user_id',
                                optionsCaption: 'Select'">
                            </select></div>
                 </div>


                    <div class="form-group">
                        <label class="col-sm-2 text-right">Hall Name <span class="text-red">*</span></label>
                        <div class="col-sm-4"><input type='text' required="required" class="form-control" data-bind="value: hall_name" name="hall_name" id="hall_name" /></div>
                    </div>

                     <div class="form-group">
                         <label class="col-sm-2 text-right">Hall Type <span class="text-red">*</span></label>
                 <div class="col-sm-10">
                 <!-- ko foreach: hall_type() -->
   <div class="checkbox-inline no-top-padding"> <label for="checkbox"> <input type="checkbox" name="hall_type[]" data-bind="value: hall_type_id" /><span data-bind="text:hall_type_name"></span></label></div>
                    <!-- /ko  -->
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Description <span class="text-red">*</span></label>
                        <div class="col-sm-4"><textarea name="hall_description" data-bind="value: hall_description" id="hall_description" class="form-control" rows="5" cols="150" required="required"> </textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Address<span class="text-red">*</span></label>
                        <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: hall_address" name="hall_address" id="hall_address" /></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Location<span class="text-red">*</span></label>
                        <div class="col-sm-4">  <select class="form-control" id="location_id" required="required" name="location_id"
                                data-bind="value: location_id,
                                options: myOptions,
                                optionsText: 'location_name',
                                optionsValue: 'location_id',
                                optionsCaption: 'Select'">
                            </select> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Province<span class="text-red">*</span></label>
                        <div class="col-sm-4">
                        <select class="form-control" id="hall_province" required="required" name="hall_province"
                                data-bind="value: hall_province,
                                options: provinceOptions,
                                optionsText: 'province_name',
                                optionsValue: 'id',
                                optionsCaption: 'Select Province'">
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Post Code<span class="text-red"></span></label>
                        <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: hall_postcode" name="hall_postcode" id="hall_postcode" /> </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 text-right">Amount<span class="text-red">*</span></label>
                        <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: rental_amount" name="rental_amount" required="required" id="rental_amount" /></div>                    <div class="col-sm-2 no-padding"><span class="text-aoa">AOA</span></div>

                    </div>
                     <div class="display_user_details1" style="display: block !important;">
                                 <div class="form-group">
                                    <label class="col-sm-2 text-right">Official Name <span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: official_name" name="official_name" id="official_name" required="required"/>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 text-right">Contact Name <span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: contact_name" name="contact_name" id="contact_name" required="required"/>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 text-right">Contact Email<span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: contact_email" name="contact_email" id="contact_email" required="required"/>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 text-right">Contact Mobile <span class="text-red">*</span></label>
                                    <div class="col-sm-4"><input type='text' class="form-control" data-bind="value: contact_mobile" name="contact_mobile" id="contact_mobile" required="required"/>
                                </div>
                                </div>
                        </div>
                    <div class="form-group">
                        <label class="col-sm-2 text-right">Is Active <span class="text-red"></span></label>
                        <div class="col-sm-4">  <input type='checkbox' class="" data-bind="value: is_active" name="is_active" id="is_active" checked="checked" /> </div>
                    </div>
                     <!-- /ko -->



                </div>
                 <div class="box-footer text-right"><div class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </div><span class="alert alert-success alert-sm save_msg" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $saveBtn }}</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>


               </div>
                    <div role="tabpanel" class="tab-pane" id="uploadImg">
                        <div class="box-header with-border">
                            <h3 class="box-title">Upload Image<span class="spinner-loader" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span>123</h3>
                        </div>
                       	<div class="box-body">
                        Content...

                        </div>
                        <div class="box-footer text-right"><div class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </div><span class="alert alert-success alert-sm save_msg" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> Save</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="addAddon">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Addon<span class="spinner-loader" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span></h3>
                        </div>
                       	<div class="box-body">
                        Content...

                        </div>
                        <div class="box-footer text-right"><div class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </div><span class="alert alert-success alert-sm save_msg" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> Save</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>
                  </div>
                    <div role="tabpanel" class="tab-pane" id="addACMD">
                   		<div class="box-header with-border">
                            <h3 class="box-title">Add Accommodation<span class="spinner-loader" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span></h3>
                        </div>
                       	<div class="box-body">
                        Content...
                        </div>
                        <div class="box-footer text-right"><span class="spinner-loader pull-left" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span>
                        <span class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </span><span class="alert alert-success alert-sm pull-left save_msg" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $saveBtn }}</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>

                    </div>
                  </div>

                </div>




            </form>

        </div>






@endsection
@section('script')

{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}

{{ Html::script('public/js/add_hall.js') }}
@endsection