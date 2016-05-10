 <div class="box box-default" id="recordset">			   
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
						<tr class="warning">                                
							<th width="70%">
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','atrans.hall_type_name')">HALL TYPE NAME <i id="hall_type_name" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>                       	
							<th width="15%" class="text-center">ORDER</th>
                            <th width="15%" class="text-right">ACTIONS</th>
                        </tr>
						@if($data['dataGrid'])
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>{{$dataset->hall_type_name}}
							@if($data['update_id']==$dataset->hall_type_id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->hall_type_id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							<td class="text-center">
							
							@if($data['hide_order']== 0)
								@if($dataset->order_id!=$data['maxorder'])
									<a href="javascript:;" title="Down" onclick="resetorder('orderdown','{{$dataset->hall_type_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-down"></i></a>
								@endif
								@if($dataset->order_id!=$data['minorder']) 
									<a href="javascript:;" title="Up" onclick="resetorder('orderup','{{$dataset->hall_type_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-up"></i></a>
								@endif	
							@else
							--
							@endif
</td>
							<td class="text-right">
							<div class="btn-group">
							@if($dataset->is_active==1)
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->hall_type_id}}','{{$dataset->is_active}}')" title="Active"> 
							<span class="fa fa-check-square-o text-primary"></span></button>
							@else
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->hall_type_id}}','{{$dataset->is_active}}')"> 
							<span class="fa fa-square-o  text-primary" title="Inactive"></span></button>
							@endif
							
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/halltype') }}/{{$dataset->hall_type_id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
  <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->hall_type_id}})" ><span class="fa fa-trash text-danger"></span></button></div></td>
						</tr>
					    @endforeach
						@else
						<tr>
							<td colspan="4" class="text-center">{{ Html::image('public/images/admin/alert.png','Alert') }}
							<br/>No Record Found.</td>
						</tr>
						@endif
					</table>
					
				</div> 
				<div class="box-footer"> <div class="row"><div class="col-sm-6 col-md-6">{!! $data['pagenation'] !!}</div><div class="col-sm-6 col-md-6 text-right"><label class="margin">Record Per Page:</label><select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)"><option value="5" @if($data['limit']==5)selected="selected"@endif >5</option><option value="10"@if($data['limit']==10)selected="selected"@endif >10</option><option value="25" @if($data['limit']==25)selected="selected"@endif>25</option><option value="50" @if($data['limit']==50)selected="selected"@endif>50</option><option value="100" @if($data['limit']==100)selected="selected"@endif>100</option></select></div></div></div>
        </div>