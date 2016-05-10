        <div class="box box-default" id="recordset">			   
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
						<tr class="warning">                                
							<th width="30"></th>
							<th width="20%">
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.first_name')">NAME <i id="first_name" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>                       							    <th width="15%"><a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.email')">EMAIL <i id="email" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>
							<th width="10%"><a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.contact_number')">MOBILE NO. <i id="contact_number" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>
							<th width="20%">ADDRESS</th>							
							<th width="15%">REG. DATE</th>							
                            <th width="15%" class="text-right">ACTIONS</th>
                        </tr>
						@if($data['dataGrid'])
					       @foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>
							@if($dataset->user_type=='U')
							{{ Html::image('public/images/admin/user.png','User', array('title'=>'User')) }}
							@else
							{{ Html::image('public/images/admin/owner.png','Owner', array('title'=>'Owner')) }}							
							@endif
							</td>					      
							<td>{{$dataset->first_name}} {{$dataset->last_name}}
							@if($data['update_id']==$dataset->id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							<td>{{$dataset->email}}</td>
							<td>{{$dataset->contact_number}}</td>
							<td>{{$dataset->address}}</td>
							<td>{{ dateFormat($dataset->created_at) }}</td>
							<td class="text-right">
							<div class="btn-group">
							@if($dataset->is_active==1)
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->id}}','{{$dataset->is_active}}')" title="Active"> 
							<span class="fa fa-check-square-o text-primary"></span></button>
							@else
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->id}}','{{$dataset->is_active}}')"> 
							<span class="fa fa-square-o  text-primary" title="Inactive"></span></button>
							@endif
							
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/user') }}/{{$dataset->id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
  <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->id}})" ><span class="fa fa-trash text-danger"></span></button></div></td>
						</tr>
					    @endforeach
						@else
						<tr>
							<td colspan="6" class="text-center">No Record Found.</td>
						</tr>
						@endif
					</table>
					
				</div> 
				<div class="box-footer"> <div class="row"><div class="col-sm-6 col-md-6">{!! $data['pagenation'] !!}</div><div class="col-sm-6 col-md-6 text-right"><label class="margin">Record Per Page:</label><select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)"><option value="5" @if($data['limit']==5)selected="selected"@endif >5</option><option value="10"@if($data['limit']==10)selected="selected"@endif >10</option><option value="25" @if($data['limit']==25)selected="selected"@endif>25</option><option value="50" @if($data['limit']==50)selected="selected"@endif>50</option><option value="100" @if($data['limit']==100)selected="selected"@endif>100</option></select></div></div></div>
        </div>