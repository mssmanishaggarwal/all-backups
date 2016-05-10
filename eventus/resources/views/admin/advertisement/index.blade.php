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
			 
               <div class="col-sm-4"> 
                    <input type='text' id='advertisement_title' class="form-control" placeholder="Advertisement Name" name="advertisement_title" value="{{isset($data['keywords']['advertisement_title'])?$data['keywords']['advertisement_title']:''}}" />
					
                  </div>
                    <div class="col-sm-3"> 
                     <button type="button" onclick="searching('searching')" class="btn btn-primary btn-flat"> Go <span class="fa fa-angle-double-right"></span></button> 
					 <a class="btn btn-default btn-flat" href="{{ url('/admin/advertisement_list') }}"><span class="fa fa-refresh fa-fw"></span> Reset</a>
                  </div>
				 
                  </div>
                </form>

                </div>
				
                 
                </div>
				
                <div class="row">
                
                  <div class="col-sm-12 text-right margin-bottom">
                  <a href="{{ url('/admin/advertisement') }}" class="btn-dark btn"> <span class="fa fa-plus fa-fw"></span> Add Advertisement</a>
               
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

@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
    {{ Html::script('public/js/bootstrap/bootbox.js') }}
	{{ Html::script('public/js/admin/common.js') }}
@endsection