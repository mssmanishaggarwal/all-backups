@extends('layouts.backend')
@section('content')
<input  type="hidden" name="linkUrl" id="linkUrl" value="{{$data['module_ajaxurl']}}" />
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
				  <form name="searchfrm" id="searchfrm" method="POST" class="form-horizontal">
               <div class="form-group">
			 
               <div class="col-sm-3"> 
                    <input type='text' id='payment_number' class="form-control" placeholder="Payment Number" name="payment_number" value="{{isset($data['keywords']['payment_number'])?$data['keywords']['payment_number']:''}}" />
				</div>
				<div class="col-sm-3"> 
					<select class="form-control" name="payment_for" id="payment_for">
						<option value="">Select payment for</option>
                		<option value="S">Subscription</option>
                		<option value="F">Featured</option>
                		<option value="B">Booking</option>
					</select>
                  </div>
                  
                  <div class="col-sm-3"> 
					<select class="form-control" name="payment_status" id="payment_status">
						<option value="">Select payment status</option>
                		<option value="S">Success</option>
                		<option value="F">Failed</option>
                		<option value="P">Pending</option>
					</select>
                  </div>
                    <div class="col-sm-3"> 
                     <button type="button" onclick="searching('searching')" class="btn btn-primary btn-flat"> Go <span class="fa fa-angle-double-right"></span></button> 
					 <a class="btn btn-default btn-flat" href="{{ url('/admin/payment_list') }}"><span class="fa fa-refresh fa-fw"></span> Reset</a>
                  </div>
				 
                  </div>
                </form>

                </div>
				
                 
                </div>
				
                <div class="row">
                
                  <!--<div class="col-sm-12 text-right margin-bottom">
                  <a href="{{ url('/admin/payment') }}" class="btn-dark btn"> <span class="fa fa-plus fa-fw"></span> Add Accommodation</a>
               
                  </div>-->
                   <div class="col-sm-12">

    @if(!empty($data['update_id']) or !empty($data['insert_id']))
	<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> You have 
		@if(!empty($data['update_id']))
			Updated
		@elseif(!empty($data['insert_id']))
			Added
		@endif
		 successfully.
    </div>
	@endif
</div>
                  
                  </div>


        
        	
        <div class="box box-default" id="recordset">			   
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
						<tr class="warning">                                
							<th width="25%">
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.payment_number')">PAYMENT NUMBER <i id="payment_number" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>                       		<th width="15%">PAYMENT FOR</th>
							<th width="15%">AMOUNT (AOA)</th>
							<th width="15%">STATUS</th>
							<th width="15%">
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.payment_date')">PAYMENT DATE <i id="payment_date" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>
                            <th width="15%" class="text-right">ACTIONS</th>
                        </tr>
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>{{$dataset->payment_number}}
							@if($data['update_id']==$dataset->payment_id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->payment_id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							
							<td>
							@if($dataset->payment_for == 'B')
							Booking							
							@elseif($dataset->payment_for == 'S')
							Subscription							
							@elseif($dataset->payment_for == 'F')
							Featured
							@else
							--
							@endif
							</td>
							<td>{{$dataset->payment_amount}}</td>
							<td>
							@if($dataset->payment_status == 'S')
							Success							
							@elseif($dataset->payment_status == 'F')
							Failed							
							@elseif($dataset->payment_status == 'P')
							Pending
							@else
							--
							@endif
							</td>
							<td>{{isset($dataset->payment_date)?dateFormat($dataset->payment_date):''}}</td>
							
							<td class="text-right">
							<div class="btn-group">
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/payment') }}/{{$dataset->payment_id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
 <!-- <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->payment_id}})" ><span class="fa fa-trash text-danger"></span></button>-->
  								</div>
  							</td>
						</tr>
					    @endforeach
					</table>
					
				</div> 
				<div class="box-footer"> <div class="row"><div class="col-sm-6 col-md-6">{!! $data['pagenation'] !!}</div><div class="col-sm-6 col-md-6 text-right"><label class="margin">Record Per Page:</label><select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)"><option value="5" @if($data['limit']==5)selected="selected"@endif >5</option><option value="10"@if($data['limit']==10)selected="selected"@endif >10</option><option value="25" @if($data['limit']==25)selected="selected"@endif>25</option><option value="50" @if($data['limit']==50)selected="selected"@endif>50</option><option value="100" @if($data['limit']==100)selected="selected"@endif>100</option></select></div></div></div>
        </div>

@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
    {{ Html::script('public/js/bootstrap/bootbox.js') }}
@endsection