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
                    <input type='text' id='news_title' class="form-control" placeholder="News" name="news_title" value="{{isset($data['keywords']['news_title'])?$data['keywords']['news_title']:''}}" />
					
                  </div>
				  <div class="col-sm-3"> 
				  <input type='text' id='t.published_date' class="form-control datepicker" placeholder="Publish Data" name="published_date" value="{{isset($data['keywords']['t.published_date'])?$data['keywords']['t.published_date']:''}}" readonly="readonly" />
				  </div>
					
                  
                    <div class="col-sm-3"> 
                     <button type="button" onclick="searching('searching')" class="btn btn-primary btn-flat"> Go <span class="fa fa-angle-double-right"></span></button> 
					 <a class="btn btn-default btn-flat" href="{{ url('/admin/news_list') }}"><span class="fa fa-refresh fa-fw"></span> Reset</a>
                  </div>
				 
                  </div>
                </form>

                </div>
				
                 
                </div>
				
                <div class="row">
                
                  <div class="col-sm-12 text-right margin-bottom">
                  <a href="{{ url('/admin/news') }}" class="btn-dark btn"> <span class="fa fa-plus fa-fw"></span> Add News</a>
               
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
							<th width="40%">
							<a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','atrans.news_content')">NEWS <i id="news_content" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>  
							<th width="15%" class="text-left"><a href="javascript:;" onclick="ordering('ordering','{{$data['orderby']}}','t.published_date')">PUBLISH DATE <i id="news_content" class="fa fa-sort-alpha-{{$data['fa_order']}} text-muted"></i> </a></th>     
							<th width="15%" class="text-left">NEWS IMAGE</th>                   
							<th width="15%" class="text-left">CREATED BY</th>							
							<!--<th width="15%" class="text-center">ORDER</th>-->
                            <th width="15%" class="text-right">ACTIONS</th>
                        </tr>
						@foreach($data['dataGrid'] as $dataset)
						<tr>
							<td>{{$dataset->news_title}}
							@if($data['update_id']==$dataset->news_id)
								<span class="label label-info">Updated</span>
							@endif
							@if($data['insert_id']==$dataset->news_id)
								<span class="label label-success">New</span>
							@endif							
							</td>
							<td class="text-left">{{isset($dataset->published_date)?dateFormat($dataset->published_date):'' }}</td>
							<td class="text-left"><div class="img-thmb">{{Html::image('public/uploads/news/'.$dataset->news_image, $dataset->news_image, array('width'=>'100'))}}</div></td>
							<td class="text-left">{{$dataset->created_by}}</td>
							
							<!--<td class="text-center">
							
							@if($data['hide_order']== 0)
								@if($dataset->order_id!=$data['maxorder'])
									<a href="javascript:;" onclick="resetorder('orderdown','{{$dataset->news_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-down"></i></a>
								@endif
								@if($dataset->order_id!=$data['minorder']) 
									<a href="javascript:;" onclick="resetorder('orderup','{{$dataset->news_id}}','{{$dataset->order_id}}')"><i class="fa fa-caret-up"></i></a>
								@endif	
							@else
							--
							@endif
</td>-->
							<td class="text-right">
							<div class="btn-group">
                            @if($dataset->is_active==1)
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->news_id}}','{{$dataset->is_active}}')" title="Active"> 
							<span class="fa fa-check-square-o text-primary"></span></button>
							@else
							<button type="button" class="btn btn-default" onclick="setActive('setactive','{{$dataset->news_id}}','{{$dataset->is_active}}')"> 
							<span class="fa fa-square-o  text-primary" title="Inactive"></span></button>
							@endif
							
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/news') }}/{{$dataset->news_id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
  <button type="button" class="btn btn-default" title="Delete" onclick="deletedata('delete',{{$dataset->news_id}})" ><span class="fa fa-trash text-danger"></span></button>
  </div></td>
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