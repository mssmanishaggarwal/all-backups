@extends('layouts.backend')

@section('content')

       <div id="main">     
            <form id="master-file-form" novalidate="novalidate" method="post" class="form-horizontal" enctype="multipart/form-data">
            
            
            <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" class="active"><a href="add-details" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> Advertisement Details</a></li>
    <li role="presentation"><a href="add-subscription" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-bar-chart-o fa-fw"></span> statistics</a></li>

  </ul>
            
            
            <div class="box box-warning">
            <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="add-details">

<div class="box-header with-border">
                  <h3 class="box-title"> {{ $subHeading }} 
                </h3>
                  
                </div>
                <div class="box-body">
                <!-- ko if: advertisementList().length > 0 -->
                    <!-- ko foreach: advertisementList() -->
               
               <div class="form-group">
               <label class="col-sm-2 text-right"> 
                <div data-bind="if:language_id ==1">English Title <span class="text-red">*</span></div>
                        <div data-bind="if:language_id ==2">Portuguese Title <span class="text-red">*</span></div>
                        
                        </label>
                        <div class="col-sm-4"><input data-bind='attr:{id:"advertisement_title_" + language_id},value: advertisement_title' name="advertisement_title" class="form-control" type="text" required="required"/></div>
               </div>
                  <!-- ko if: $index() == ($parent.advertisementList().length-1) -->
                  
                  <div class="form-group">
						<label class="col-sm-2 text-right"> Link <span class="text-red">*</span></label>
						<div class="col-sm-4">
							<input type="url" class="form-control" data-bind="value:advertisement_link" name="advertisement_link" id="advertisement_link" required="required"/>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> Position <span class="text-red">*</span></label>
						<div class="col-sm-4">							
							<select class="form-control" id="position_id" required="required" name="position_id"
                                data-bind="value: position_id,
                                options: positionOptions,
                                optionsText: 'position_name',
                                optionsValue: 'id',
                                optionsCaption: 'Select Position'">
                            </select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> Publish Date <span class="text-red">*</span></label>
						<div class="col-sm-4">	
						<input class="form-control" name="start_date" id="start_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-bind="value: start_date" required="required" readonly="true" />					
							<!--<input type="text" class="form-control" name="start_date" id="start_date" data-bind="value:start_date" required="required" />-->
						</div>
					</div>
                    
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> Expiry Date <span class="text-red">*</span></label>
						<div class="col-sm-4">
						<input class="form-control" name="end_date" id="end_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-bind="value: end_date" required="required" readonly="true" />
							<!--<input type="text" class="form-control" name="end_date" id="end_date" data-bind="value:end_date" required="required" />-->
						</div>
					</div>
					
                  <div class="form-group"  data-bind="visible : $index() == ($parent.advertisementList().length-1)">
               <label class="col-sm-2 text-right"> Is Active</label>
                <div class="col-sm-4"><div data-bind="if: is_active == 1 ">
                                    <input type="checkbox" class="" name="is_active" id="is_active" checked="checked" />
                                 </div>
                                  <div data-bind="if: is_active == 0 ">
                                    <input type="checkbox" class="" name="is_active" id="is_active" />
                                 </div></div>
                </div>
                  <!-- /ko -->
             <!-- /ko -->
             <!-- /ko -->
             
             <!-- ko if: advertisementList().length <= 0 -->
                    @foreach($language as $lang)
                    <div class="form-group">
               <label class="col-sm-2 text-right"> {{$lang->lang_name}} Title  <span class="text-red">*</span></label>
                <div class="col-sm-4"> <input type="text" class="form-control" name="advertisement_title_{{$lang->id}}" id="advertisement_title_{{$lang->id}}" required="required"/></div>
                </div>
                    @endforeach
                    
                    <div class="form-group">
						<label class="col-sm-2 text-right"> Link <span class="text-red">*</span></label>
						<div class="col-sm-4">
							<input type="url" class="form-control" name="advertisement_link" id="advertisement_link" required="required"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> Image  <span class="text-red">*</span></label>
						<div class="col-sm-4">
						
					<!--{!! Form::file('images') !!}
						    <p class="errors">{!!$errors->first('images')!!}</p>
						<span class="text-muted">Only upload .jpeg/.png/.jpg images</span>
							
							<input type="file" accept="image/*" name="img" data-bind="value: img, fileAdded: img, previewFunc: function(files){ $data.uploadPreview(files) }" />-->
							<input type="file" name="advertisement_image" id="advertisement_image" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> Position  <span class="text-red">*</span></label>
						<div class="col-sm-4">							
							<select class="form-control" id="position_id" required="required" name="position_id"
                                data-bind="value: position_id,
                                options: positionOptions,
                                optionsText: 'position_name',
                                optionsValue: 'id',
                                optionsCaption: 'Select Position'">
                            </select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> Publish Date  <span class="text-red">*</span></label>
						<div class="col-sm-4">							
							<!--<input class="form-control" id="start_date" data-bind="datepicker: start_date, datepickerOptions: { minDate: new Date(),dateFormat: 'yy-mm-dd' }" />	-->	
							<input type="text" class="form-control" id="start_date" name="start_date" data-date-format="dd/mm/yyyy" data-provide="datepicker" required="required" readonly="true"/>					
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> Expiry Date  <span class="text-red">*</span></label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="end_date" name="end_date" data-date-format="dd/mm/yyyy" data-provide="datepicker" required="required" readonly="true"/>
						</div>
					</div>
                    
                    
					<div class="form-group">
						<label class="col-sm-2 text-right"> Is Active</label>
						<div class="col-sm-4">
							<input type="checkbox" class="" name="is_active" id="is_active" checked="checked" value="1"/>
						</div>
					</div>                 
                 
                    <!-- /ko -->

                </div>
                <div class="box-footer text-right"><span class="spinner-loader pull-left" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span> <span class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </span>
                             <span class="alert alert-success alert-sm save_msg pull-left" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $saveBtn }}</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>
                  </div>
                  
                  <div role="tabpanel" class="tab-pane" id="add-subscription">test content</div>
                  
                  </div>
                </div>
            </form>           
        </div>
@endsection
@section('script')

    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}

    {{ Html::script('public/js/add_advertisement.js') }}
@endsection