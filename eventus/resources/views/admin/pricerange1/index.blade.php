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
               <div class="form-group"><div class="col-sm-4">
                    <input type='text' id='price_range_title' class="form-control" placeholder="Title" name="price_range_title"/></div>
                    <input type="hidden" name="currency_id" id="currency_id" value="1"/>
                    <div class="col-sm-4">
                    <button type="button" class="btn btn-primary btn-flat" data-bind="click: searchClient">Go <span class="fa fa-angle-double-right"></span></button>
                     <button type="button" class="btn btn-default btn-flat" data-bind="click: setReset" ><span class="fa fa-refresh fa-fw"></span> Reset</button>
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
                    <select data-bind="options: availableSorting,optionsCaption: 'Select'" class="form-control" id="sorting"></select>
                 </div>
                 <div class="col-sm-3">
                 <div class="btn-group">
                    <button  class="btn-default btn btn-flat" data-bind="click: sortClientASC"> <span class="fa fa-sort-alpha-asc text-default"></span></button>
                        <button  class="btn-default  btn btn-flat" data-bind="click: sortClientDESC"><span class="fa fa-sort-alpha-desc text-muted"></span></button>
                    </div></div>
                    
                 
                 </div>
                 </div>
                  <div class="col-sm-6 text-right">
                  <!--<a href="{{ url('/admin/pricerange?currency_id=1') }}" class="btn-dark btn"> <span class="fa fa-plus fa-fw"></span> Add Price Range</a>-->                  
                  <button class="btn-dark btn" data-bind="click: addRange"> <span class="fa fa-plus fa-fw"></span><span id="add_range">Add AOA Price Range</span></button>
                  </div>
                  </div>                  
                  
                    <ul class="nav nav-tabs custom-tab" role="tablist">
    <li id="angloid" role="presentation" class="active"><a data-bind="click: showAnglo" href="javascript:;" aria-controls="home" role="tab" data-toggle="tab">AOA</a></li>
    <li id="euroid" role="presentation"><a data-bind="click: showEuro" href="javascript:;" class="disable_link">Euro</a></li>     
  </ul>
                  
                   <!-- Tab panes -->
        <div class="box box-warning">
				
                <div class="box-body no-padding">
                    

                    <table class="table table-striped clientlist-table">
                            <thead>
                            <tr>
                                <th>Title</th>                                
                                <th>Lower Range <small class="text-muted"> (AOA)</small></th>                                
                                <th>Upper Range <small class="text-muted"> (AOA)</small></th>                                
                                <th class="text-right">ACTIONS</th>
                            </tr>
                            </thead>

                            <tbody class="data-values">
							<!--ko foreach: paginatedData -->							
                            <tr>
                                <td><span data-bind="text: price_range_title"></span></td>
                                <td><span data-bind="text: lower_range"></span></td>
                                <td><span data-bind="text: upper_range"></span></td>
								<td align="right"> <div class="btn-group action_div"><button type="button" data-bind="click: $root.btnEdit"  class="btn btn-default "> <span class="fa fa-edit text-default"></span></button>			
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
                             <button class="btn btn-default btn-sm btn-prev" data-bind="click: previous, enable: hasPrevious"><span class="fa fa-angle-left"></span></button>
                             <button class="btn btn-default btn-sm btn-next" data-bind="click: next, enable: hasNext"><span class="fa fa-angle-right"></span></button> </div>
                    <div id="error_msg"></div>
                    
                  </div>
        </div>
        
           
        
        
  </form>       
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
    {{ Html::script('public/js/bootstrap/bootbox.js') }}
    {{ Html::script('public/js/pricerange_list.js') }}
@endsection
