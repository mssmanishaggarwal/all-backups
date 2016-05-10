        <div class="box box-default" id="recordset">			   
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
						<tr class="warning">                                
							<th width="25%">
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','atrans.advertisement_title')">ADVERTISEMENT NAME <i id="advertisement_name" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th> 
							<th width="10%"><a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.start_date')">START DATE <i id="start_date" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>
							<th width="10%"><a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.end_date')">END DATE <i id="end_date" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>
							<th width="25%">ADVERTISEMENT IMAGE</th> 
							<th width="15%">POSITION</th>
							<!--<th width="15%" class="text-center">ORDER</th>-->
                            <th width="20%" class="text-right">ACTIONS</th>
                        </tr>
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>{{$dataset->advertisement_title}}
							@if($data['update_id']==$dataset->advertisement_id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->advertisement_id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							<td>{{isset($dataset->start_date)?dateFormat($dataset->start_date):'' }}</td>
							<td>{{isset($dataset->end_date)?dateFormat($dataset->end_date):''}}</td>
							<td class="text-left"><div class="img-thmb">{{Html::image('public/uploads/advertisement/'.$dataset->advertisement_image, $dataset->advertisement_title, array('width'=>'100'))}}</div></td>
							
							<td>{{($dataset->position_id==1)?'Home Page Top':'Home Page Bottom'}}</td>
							<!--<td class="text-center">
							
							@if($data['hide_order']== 0)
								@if($dataset->order_id!=$data['maxorder'])
									<a href="javascript:;" onclick="resetorder('orderdown','{{$dataset->advertisement_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-down"></i></a>
								@endif
								@if($dataset->order_id!=$data['minorder']) 
									<a href="javascript:;" onclick="resetorder('orderup','{{$dataset->advertisement_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-up"></i></a>
								@endif	
							@else
							--
							@endif
</td>-->
							<td class="text-right">
							<div class="btn-group">
							@if($dataset->is_active==1)
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->advertisement_id}}','{{$dataset->is_active}}')" title="Active"> 
							<span class="fa fa-check-square-o text-primary"></span></button>
							@else
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->advertisement_id}}','{{$dataset->is_active}}')"> 
							<span class="fa fa-square-o  text-primary" title="Inactive"></span></button>
							@endif
							
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/advertisement_statistics') }}/{{$dataset->advertisement_id}}'" title="Statistics"><span class="fa fa-bar-chart"></span></button>
							
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/advertisement') }}/{{$dataset->advertisement_id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
  <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->advertisement_id}})" ><span class="fa fa-trash text-danger"></span></button></div></td>
						</tr>
					    @endforeach
					</table>
					
				</div> 
				<div class="box-footer"> <div class="row"><div class="col-sm-6 col-md-6">{!! $data['pagenation'] !!}</div><div class="col-sm-6 col-md-6 text-right"><label class="margin">Record Per Page:</label><select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)"><option value="5" @if($data['limit']==5)selected="selected"@endif >5</option><option value="10"@if($data['limit']==10)selected="selected"@endif >10</option><option value="25" @if($data['limit']==25)selected="selected"@endif>25</option><option value="50" @if($data['limit']==50)selected="selected"@endif>50</option><option value="100" @if($data['limit']==100)selected="selected"@endif>100</option></select></div></div></div>
        </div>