        <div class="box box-default" id="recordset">			   
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
						<tr class="warning">                                
							<th width="85%">
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.email_title')">EMAIL TEMPLATE <i id="email_name" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>                       	
							<!--<th width="15%" class="text-center">ORDER</th>-->
                            <th width="15%" class="text-right">ACTIONS</th>
                        </tr>
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>{{$dataset->email_title}}
							@if($data['update_id']==$dataset->email_id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->email_id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							<!--<td class="text-center">
							
							@if($data['hide_order']== 0)
								@if($dataset->order_id!=$data['maxorder'])
									<a href="javascript:;" onclick="resetorder('orderdown','{{$dataset->email_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-down"></i></a>
								@endif
								@if($dataset->order_id!=$data['minorder']) 
									<a href="javascript:;" onclick="resetorder('orderup','{{$dataset->email_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-up"></i></a>
								@endif	
							@else
							--
							@endif
</td>-->
							<td class="text-right">
							<div class="btn-group">
														
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/email') }}/{{$dataset->email_id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
  <!--<button type="button" class="btn btn-default" title="Delete"><span class="fa fa-trash text-danger  text-muted"></span></button>--></div></td>
						</tr>
					    @endforeach
					</table>
					
				</div> 
				<div class="box-footer"> <div class="row"><div class="col-sm-6 col-md-6">{!! $data['pagenation'] !!}</div><div class="col-sm-6 col-md-6 text-right"><label class="margin">Record Per Page:</label><select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)"><option value="5" @if($data['limit']==5)selected="selected"@endif >5</option><option value="10"@if($data['limit']==10)selected="selected"@endif >10</option><option value="25" @if($data['limit']==25)selected="selected"@endif>25</option><option value="50" @if($data['limit']==50)selected="selected"@endif>50</option><option value="100" @if($data['limit']==100)selected="selected"@endif>100</option></select></div></div></div>
        </div>