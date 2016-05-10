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
                                       <input type='text' id='hall_name' class="form-control" placeholder="Hall Name" name="hall_name" value="{{isset($data['keywords']['hall_name'])?$data['keywords']['hall_name']:''}}" />
                                  </div>
                                  
               						<div class="col-sm-3">
                                	<input type='text' id='user_name' class="form-control" placeholder="User Name" name="user_name" value="{{isset($data['keywords']['atrans.official_name'])?$data['keywords']['atrans.official_name']:''}}" />
                                    </div>
                                    <div class="col-sm-3">
		                            <select class="form-control" id="location_id" name="location_id">
								 	<option value="">Select Location</option>
									@foreach($data['locations'] as $ct)
										<option value="{{$ct->location_id}}" {{isset($data['keywords']['location_id'])?($data['keywords']['location_id']==$ct->location_id)?'selected':'':''}}>{{$ct->location_name}}</option>
									@endforeach
								 	</select>
                                    </div>
                                     <div class="col-sm-3">
                                       <select class="form-control" id="hall_province" name="hall_province">
									 	<option value="">Select Province</option>
										@foreach($data['province'] as $st)
											<option value="{{$st->id}}" {{isset($data['keywords']['hall_province'])?($data['keywords']['hall_province']==$st->id)?'selected':'':''}}>{{$st->province_name}}</option>
										@endforeach
									 </select> 										
                                    </div>
                          </div>
                          <div class="form-group">
                                <div class="col-sm-3">
                                       <select  class="form-control" name="date_type" id="date_type">
				                    	<option value="A">Hall Added Date</option>
				                    	<option value="E">Expiry Date</option>
									</select>
                                  </div>
                                <div class="col-sm-3">
                                       <input type='text' id='from_date' class="form-control datepicker" placeholder="From" name="from_date" value="{{isset($data['keywords']['from_date'])?$data['keywords']['from_date']:''}}" />
                                </div>


                                    <div class="col-sm-3">                                       
										<input type='text' id='to_date' class="form-control datepicker" placeholder="To" name="to_date" value="{{isset($data['keywords']['to_date'])?$data['keywords']['to_date']:''}}" />
                                    </div>


               <div class="col-sm-3 text-left">
                    <button type="button" onclick="searching('searching')" class="btn btn-primary btn-flat"> Go <span class="fa fa-angle-double-right"></span></button> 
					 <a class="btn btn-default btn-flat" href="{{ url('/admin/hall_list') }}"><span class="fa fa-refresh fa-fw"></span> Reset</a>

                  </div>
              </div>
			  </form>
          </div>



                <div class="box-footer">
                    <p> <div id="error_msg"></div></p>
                  </div>
                </div>
				
                <div class="row">
                
                  <div class="col-sm-12 text-right margin-bottom">
                  <a href="{{ url('/admin/hall') }}" class="btn-dark btn"> <span class="fa fa-plus fa-fw"></span> Add Hall</a>
               
                  </div>
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
              <th width="15%">HALL NAME</th>							    
              <th width="15%">USER</th>
              <th width="15%">SUBSCRIPTION</th>
			  <th width="10%">RENTAL AMOUNT(AOA)</th>
              <th width="15%">DATE</th>
              <th class="text-right" width="30%">ACTIONS</th>
            </tr>
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td><strong>{{$dataset->hall_name}}</strong>
							@if($data['update_id']==$dataset->id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->id)
								<span class="label label-success">New</span>
							@endif
							<br/><small><i class="fa fa-map-marker"></i> {{$dataset->location_name}},{{$dataset->province_name}}, {{$dataset->hall_postcode}}</small>						
							</td>							
							<td><strong>{{$dataset->first_name}} {{$dataset->last_name}}</strong></br>
							<em>{{$dataset->email}}</em></br>
							<span class="text-muted"> {{$dataset->contact_number}}</span>
							</td>
							<td>{{isset($dataset->subscription_name)?($dataset->subscription_name):'--'}}</td>
							 <td>{{$dataset->rental_amount}}</td>							
							<td>Add: <small>{{isset($dataset->created_at)?dateFormat($dataset->created_at):''}}</small>
							<br />Expiry: <small>{{isset($dataset->expiry_date)?dateFormat($dataset->expiry_date):'--'}}</small></td>	
                           

							<!--<td class="text-center">
							
							@if($data['hide_order']== 0)
								@if($dataset->order_id!=$data['maxorder'])
									<a href="javascript:;" onclick="resetorder('orderdown','{{$dataset->id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-down"></i></a>
								@endif
								@if($dataset->order_id!=$data['minorder']) 
									<a href="javascript:;" onclick="resetorder('orderup','{{$dataset->id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-up"></i></a>
								@endif	
							@else
							--
							@endif
</td>-->
							<td class="text-right" width="332">
							<div class="btn-group">
								@if($dataset->is_active==1)
									<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->id}}','{{$dataset->is_active}}')" title="Active"><span class="fa fa-check-square-o text-primary"></span></button>
								@else
									<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->id}}','{{$dataset->is_active}}')"><span class="fa fa-square-o  text-primary" title="Inactive"></span></button>
								@endif
								<button title="Edit" type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/hall') }}/{{$dataset->id}}'"> <span class="fa fa-edit text-warning"></span></button>
								<button title="Upload" type="button" class="btn btn-default " onclick="document.location.href='{{ url('/admin/hall_uploadimage') }}/{{$dataset->id}}'"><span class="fa fa-upload text-default"></span></button>
                <button title="Addon" type="button" class="btn btn-default " onclick="document.location.href='{{ url('/admin/hall_addon') }}/{{$dataset->id}}'"><span class="fa fa-puzzle-piece text-default"></span></button>
                <button title="Accommodation" type="button" class="btn btn-default " onclick="document.location.href='{{ url('/admin/hall_accommodation') }}/{{$dataset->id}}'"><span class="fa fa-bed text-default"></span></button>
                <button title="Subscription" type="button" class="btn btn-default " onclick="document.location.href='{{ url('/admin/hall_subscription') }}/{{$dataset->id}}'"><span class="fa fa-cube text-default"></span></button>
                <button title="Calender" type="button" class="btn btn-default " onclick="document.location.href='{{ url('/admin/hall_calender') }}/{{$dataset->id}}'"><span class="fa fa-calendar text-default"></span></button>
                <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->id}})"><span class="fa fa-trash text-danger text-muted"></span></button>
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
	{{ Html::script('public/js/admin/common.js') }}
@endsection