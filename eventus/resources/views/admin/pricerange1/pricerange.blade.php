@extends('layouts.backend')

@section('content')
       

       <div id="main">        
            <form id="master-file-form" novalidate="novalidate" class="form-horizontal">
            
            <div class="box box-warning">

<div class="box-header with-border">
                  <h3 class="box-title"> {{ $subHeading }} 
                </h3>
                  
                </div>
                <div class="box-body">
                <!-- ko if: priceRangelist().length > 0 -->
                    <!-- ko foreach: priceRangelist() -->
               
               <div class="form-group">
               <label class="col-sm-2 text-right"> 
                <div data-bind="if:language_id ==1">English Name <span class="text-red">*</span></div>
                        <div data-bind="if:language_id ==2">Portuguese Name <span class="text-red">*</span></div>
                        </label>
                        <div class="col-sm-4"><input data-bind='attr:{id:"price_range_title_" + language_id},value: price_range_title' name="price_range_title" class="form-control" type="text" required="required"/></div>
               </div>
               <!-- ko if: $index() == ($parent.priceRangelist().length-1) -->
               <!--<div class="form-group">
               			<label class="col-sm-2 text-right">Select Currency</label>
	                    <div class="col-sm-4">
	                    	<select class="form-control" id="currency_id" required="required" name="currency_id"
                                data-bind="value: currency_id,
                                options: currencyOptions,
                                optionsText: 'currency_name',
                                optionsValue: 'currency_id',
                                optionsCaption: 'Select'">
                            </select>
	                    </div>
                    </div>-->
                    
                    <div class="form-group">
               			<label class="col-sm-2 text-right"> Lower Range <span class="text-red">*</span></label>
	                    <div class="col-sm-4">
	                    	<input type="text" data-bind="value:lower_range" class="form-control" name="lower_range" id="lower_range" disabled="disabled"/>
	                    </div>
	                    <div class="col-sm-4 no-padding"><span class="text-aoa">AOA</span></div>
                    </div>
                    
                    <div class="form-group">
               			<label class="col-sm-2 text-right"> Upper Range <span class="text-red">*</span></label>
	                    <div class="col-sm-4">
	                    	<input type="text" data-bind="value:upper_range" class="form-control" name="upper_range" id="upper_range" disabled="disabled"/>
	                    </div>
	                    <div class="col-sm-4 no-padding"><span class="text-aoa">AOA</span></div>
                    </div>              
                  
                 
                  <!-- /ko -->
             <!-- /ko -->
            <!-- /ko -->
             <!-- ko if: priceRangelist().length <= 0 -->
                    @foreach($language as $lang)
                    <div class="form-group">
		               	<label class="col-sm-2 text-right"> {{$lang->lang_name}} Title <span class="text-red">*</span></label>
		            	<div class="col-sm-4"> <input type="text" class="form-control" name="price_range_title_{{$lang->id}}" id="price_range_title_{{$lang->id}}" required="required"/></div>
                	</div>
                
                    @endforeach
                    
                    <!--<div class="form-group">
               			<label class="col-sm-2 text-right">Select Currency</label>
	                    <div class="col-sm-4">
	                    	<select class="form-control" id="currency_id" required="required" name="currency_id"
                                data-bind="value: currency_id,
                                options: currencyOptions,
                                optionsText: 'currency_name',
                                optionsValue: 'currency_id',
                                optionsCaption: 'Select'">
                            </select>
	                    </div>
                    </div>-->
                    
                    <div class="form-group">
               			<label class="col-sm-2 text-right"> Lower Range <span class="text-red">*</span></label>
	                    <div class="col-sm-4">
	                    	<input type="text" class="form-control" name="lower_range" id="lower_range" value="{{$lowerRange }}" disabled="disabled"/>
	                    </div>
	                    <div class="col-sm-4 no-padding"><span class="text-aoa">AOA</span></div>
                    </div>
                    
                    <div class="form-group">
               			<label class="col-sm-2 text-right"> Upper Range <span class="text-red">*</span></label>
	                    <div class="col-sm-4">
	                    	<input type="text" class="form-control" name="upper_range" id="upper_range"/>
	                    </div>
	                    <div class="col-sm-4 no-padding"><span class="text-aoa">AOA</span></div>
                    </div>       
                 
                    <!-- /ko -->
            
            

                </div>
                <div class="box-footer text-right">
                <span class="spinner-loader pull-left" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span>
                
                <span class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </span>
                            <span class="alert alert-success alert-sm save_msg pull-left" style="display: none;">{{ trans('messages.saved') }}</span>
							<input type="hidden" id="currency_id" value="{{ $currency_id }}"/>
                            <button type="submit" data-bind="click: save" class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save"></span> {{ $saveBtn }}</button>
                            <button type="button" data-bind="click: cancel" class="btn btn-default " id="cloneButton"><span class="fa fa-refresh"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>
                </div>
                
                

            </form>
            
        </div>
@endsection
@section('script')

    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}

    {{ Html::script('public/js/add_pricerange.js') }}
@endsection