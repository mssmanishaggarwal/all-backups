        <div class="box box-default" id="recordset">			   
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
						<tr class="warning">                                
							<th width="30%">							
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','atrans.banner_title')">HOME PAGE BANNER  <i id="banner_title" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>      
							<th width="10%" class="text-center">PUBLISH DATE</th>
							<th width="10%" class="text-center">EXPIRY DATE</th> 
							<th width="20%">BANNER IMAGE</th>							                	
							<th width="10%" class="text-center">ORDER</th>
                            <th width="15%" class="text-right">ACTIONS</th>
                        </tr>
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>{{$dataset->banner_title}}
							@if($data['update_id']==$dataset->id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							<td><span>{{isset($dataset->publish_date)?dateFormat($dataset->publish_date):'' }}</span></td>
							<td><span>{{isset($dataset->expiry_date)?dateFormat($dataset->expiry_date):'' }}</span></td>
							<td><div class="img-thmb">{{Html::image('public/uploads/banner/'.$dataset->banner_image, $dataset->banner_title, array('width'=>'100'))}}</div></td>
							
							
							<td class="text-center">
							
							@if($data['hide_order']== 0)
								@if($dataset->order_id!=$data['maxorder'])
									<a href="javascript:;" title="Down" onclick="resetorder('orderdown','{{$dataset->id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-down"></i></a>
								@endif
								@if($dataset->order_id!=$data['minorder']) 
									<a href="javascript:;" title="Up" onclick="resetorder('orderup','{{$dataset->id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-up"></i></a>
								@endif	
							@else
							--
							@endif
</td>
							<td class="text-right">
							<div class="btn-group">
							@if($dataset->is_active==1)
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->id}}','{{$dataset->is_active}}')" title="Active"> 
							<span class="fa fa-check-square-o text-primary"></span></button>
							@else
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->id}}','{{$dataset->is_active}}')"> 
							<span class="fa fa-square-o  text-primary" title="Inactive"></span></button>
							@endif
							
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/homepagebanner') }}/{{$dataset->id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
  <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->id}})" ><span class="fa fa-trash text-danger"></span></button></div></td>
						</tr>
					    @endforeach
					</table>
					
				</div> 
				<div class="box-footer"> <div class="row"><div class="col-sm-6 col-md-6">{!! $data['pagenation'] !!}</div><div class="col-sm-6 col-md-6 text-right"><label class="margin">Record Per Page:</label><select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)"><option value="5" @if($data['limit']==5)selected="selected"@endif >5</option><option value="10"@if($data['limit']==10)selected="selected"@endif >10</option><option value="25" @if($data['limit']==25)selected="selected"@endif>25</option><option value="50" @if($data['limit']==50)selected="selected"@endif>50</option><option value="100" @if($data['limit']==100)selected="selected"@endif>100</option></select></div></div></div>
        </div>