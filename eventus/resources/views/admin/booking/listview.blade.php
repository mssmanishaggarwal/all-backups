        <div class="box box-default" id="recordset">			   
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
						<tr class="warning">                                
							<th width="15%"><a href="">BOOKING NUMBER </a></th>
							<th width="15%"><a href="">BOOKING BY </a></th>
							<th width="10%"><a href="">HALL </a></th>
							<th width="10%"><a href="">HALL BOOK DATE </a></th>
							<th width="10%"><a href="">RENTAL AMOUNT </a></th>
							<th width="10%"><a href="">BOOKING AMOUNT </a></th>
							<th width="12%"><a href="">BOOKING DATE&TIME </a></th>
							<th width="10%"><a href="">BOOKING STATUS </a></th>
	            			<th width="20%" class="text-right">ACTIONS</th>
            </tr>
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>{{$dataset->booking_number}}
							@if($data['update_id']==$dataset->booking_id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->booking_id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							<td>
								<span>{{$dataset->user_first_name.' '.$dataset->user_last_name}}</span><br/>
								<span>{{$dataset->user_email}}</span>
							</td>
							<td>
								<span>{{$dataset->hall_name}}</span><br/>
								<span>{{$dataset->hall_location_name}}</span>
								<span>{{!empty($dataset->hall_province_name)?' ,'.$dataset->hall_province_name:''}}</span>
							</td>
							<td>
								<span>{{isset($dataset->check_in)?dateFormat($dataset->check_in):''}}</span><br />
								<span>{{isset($dataset->check_out)?dateFormat($dataset->check_out):''}}</span>
							</td>
							<td><span>{{$dataset->rental_amount}}</span></td>
							<td><span>{{$dataset->booking_amount}}</span></td>
							<td><span>{{isset($dataset->booking_datetime)?dateTimeFormat($dataset->booking_datetime):''}}</span></td>
							<td>
								<span>{{$data['status_array'][$dataset->booking_status]}}</span>
							</td>
							<td class="text-right">
								<div class="btn-group">
							
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/booking') }}/{{$dataset->booking_id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
  <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->booking_id}})" ><span class="fa fa-trash text-danger"></span></button>
  								</div>
  							</td>
						</tr>
					    @endforeach
					</table>
					
				</div> 
				<div class="box-footer"> <div class="row"><div class="col-sm-6 col-md-6">{!! $data['pagenation'] !!}</div><div class="col-sm-6 col-md-6 text-right"><label class="margin">Record Per Page:</label><select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)"><option value="5" @if($data['limit']==5)selected="selected"@endif >5</option><option value="10"@if($data['limit']==10)selected="selected"@endif >10</option><option value="25" @if($data['limit']==25)selected="selected"@endif>25</option><option value="50" @if($data['limit']==50)selected="selected"@endif>50</option><option value="100" @if($data['limit']==100)selected="selected"@endif>100</option></select></div></div></div>
        </div>