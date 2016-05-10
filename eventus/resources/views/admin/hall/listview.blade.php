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