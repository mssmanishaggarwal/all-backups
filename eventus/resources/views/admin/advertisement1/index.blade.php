@extends('layouts.backend')

@section('content')
<form class="form-horizontal">
<div class="box search-box">

<div class="box-header with-border">
                  <h3 class="box-title">Search Filters <span id="spinner-loader-search" style="display: none;">
                                    {{ Html::image('public/images/loader.gif') }}
                                </span></h3>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-angle-up"></i></button>
                  </div>
                </div>
                <div class="box-body">
               <div class="form-group">
               <div class="col-sm-3"> 
                    <input type='text' id='advertisement_title' class="form-control" placeholder="Advertisement Title" name="advertisement_title"/>
                  </div>
                  
                  
                  
                  <div class="col-sm-3"> 
                    <select class="form-control" name="search_with_date" id="search_with_date">
                    	<option value="">Select date range</option>
                    	<option value="P">Publish date</option>                    	
                    	<option value="E">Expiry date</option>                    	
                    </select>
                  </div>
                  
                  <div class="col-sm-3">
                  		<input class="form-control" type="text" id="search_start_date" placeholder="Select Date">
                  </div>
                  <div class="col-sm-3">
                  		<input class="form-control" type="text" id="search_end_date" placeholder="Select Date">
                  </div>
                  
                  </div>
                    <div class="form-group">
                  
                  <div class="col-sm-3"> 
                    <select class="form-control" id="position_id" required="required" name="position_id"
                                data-bind="value: position_id,
                                options: positionOptions,
                                optionsText: 'position_name',
                                optionsValue: 'id',
                                optionsCaption: 'Select Position'">
                            </select>
                  </div>
                  
                
                  
                    <div class="col-sm-3"> 
                     <button type="button" class="btn btn-primary btn-flat" data-bind="click: searchClient">Go <span class="fa fa-angle-double-right"></span></button> <button type="button" class="btn btn-default btn-flat" data-bind="click: setReset"><span class="fa fa-refresh fa-fw"></span> Reset</button>
                  </div>
                  </div>
               

                </div>
                <div class="box-footer">
                    <p> <div id="error_msg"></div></p>
                  </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                <div class="form-group sorting-panel">
                <label class="col-sm-3">Sort Options</label>
                <div class="col-sm-6" role="sort"> 
                    <select data-bind="options: availableSorting,optionsCaption: 'Select',optionsText: 'name',optionsValue: 'id'" class="form-control" id="sorting"></select>
                 </div>
                 <div class="col-sm-3"><div class="btn-group">
                    <button  class="btn-default btn btn-flat" data-bind="click: sortClientASC"><span class="fa fa-sort-alpha-asc text-default"></span></button>
                        <button  class="btn-default  btn btn-flat" data-bind="click: sortClientDESC"><span class="fa fa-sort-alpha-desc text-muted"></span></button>
                    </div></div>
                    
                 
                 </div>
                 </div>
                  <div class="col-sm-6 text-right"><a href="{{ url('/admin/advertisement') }}" class="btn-dark btn"> <span class="fa fa-plus fa-fw"></span> Add Advertisement</a></div></div>
  
        <div class="box box-default">
					
                <div class="box-body no-padding">
                    

                    <table class="table table-striped clientlist-table">
                            <thead>
                            <tr>
                            	<th>Title</th>  
                                <th>Image</th>                                    
                            	<th>Link</th>                                
                            	<th>Publish Date</th>                                
                            	<th>Expiry Date</th>                                
                                <th class="text-right">ACTIONS</th>
                            </tr>
                            </thead>

                            <tbody class="data-values">
							<!--ko foreach: paginatedData -->
                            <tr> <td><span data-bind="text: advertisement_title"></span></td>
                                <td>{{ Html::image('public/images/admin/advertisement-noimg.jpg', 'User', array('class' => 'thumbnail')) }}</td>
                                <!--<td>
                                <img data-bind="attr:{ src: 'public/uploads/adv/' + advertisement_image }" /></td>-->
                                <td><span data-bind="text: advertisement_link"></span></td>
                                <td><span data-bind="text: start_date"></span></td>
                                <td><span data-bind="text: end_date"></span></td>
                                


								<td align="right"> <div class="btn-group action_div">
                                <button type="button" data-bind="click: $root.btnEdit"  class="btn btn-default "> <span class="fa fa-edit text-default"></span></button>
                                 <button type="button" data-bind="click: $root.btnEdit"  class="btn btn-default "> <span class="fa fa-bar-chart-o text-default"></span></button>
                          
  <button type="button" data-bind="click: $root.btnDelete"  class="btn btn-default"><span class="fa fa-trash  text-muted"></span></button>
</div>
                                </td>

                            </tr>
							<!-- /ko -->
                            </tbody>
                            
                        </table>
                </div>
             <div class="box-footer">
             <div class="pagination">
           <span class="spinner-loader">
                                {{ Html::image('public/images/loader.gif') }}
                            </span><span class="text-muted"> {{ trans('messages.page') }}</span>  <span data-bind="text: pageNumber() + 1" ></span> {{ trans('messages.of') }} <span data-bind="text: lastPage"></span></div>
                            <div class="pull-right">
                             <button class="btn btn-default btn-sm btn-prev"  data-bind="click: previous, enable: hasPrevious" ><span class="fa fa-angle-left"></span></button>
                            
                             <button class="btn btn-default btn-sm btn-next" data-bind="click: next, enable: hasNext"><span class="fa fa-angle-right"></span></button> </div>
                    <div id="error_msg"></div>
                    
                  </div>
        </div>
        
  </form>       
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
    {{ Html::script('public/js/bootstrap/bootbox.js') }}
    {{ Html::script('public/js/advertisement_list.js') }}
@endsection
