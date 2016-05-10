@extends('layouts.backend')
@section('content')
<input  type="hidden" name="linkUrl" id="linkUrl" value="{{$data['module_ajaxurl']}}"/>
<div class="box search-box">
	<div class="box-header with-border">
		<h3 class="box-title">Search Filters <span id="spinner-loader-search" style="display: none;">{{ Html::image('public/images/loader.gif') }}</span></h3>
		<div class="box-tools pull-right">
			<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-angle-up"></i></button>
		</div>
	</div>
	<div class="box-body">
		<form name="searchfrm" id="searchfrm" method="POST" class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-4"> 
					<input type='text' id='sitevariable_name' class="form-control" placeholder="Sitevariable Name" name="sitevariable_name" value="{{isset($data['keywords']['sitevariable_name'])?$data['keywords']['sitevariable_name']:''}}" />
				</div>
				<div class="col-sm-3"> 
					<button type="button" onclick="searching('searching')" class="btn btn-primary btn-flat"> Go <span class="fa fa-angle-double-right"></span></button> 
					<a class="btn btn-default btn-flat" href="{{ url('/admin/sitevariable_list') }}"><span class="fa fa-refresh fa-fw"></span> Reset</a>
				</div>
			</div>
		</form>
	</div>
</div>
				
<div class="row">
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
				<th width="50%">SITE VARIABLE NAME </th>
				<th width="20%">DATE EDITED</th>
				<th width="30%" class="text-right">ACTIONS</th>
			</tr>
			@foreach($data['dataGrid'] as $dataset)
				<tr>
					<td>{{$dataset->sitevariable_name}}
						@if($data['update_id']==$dataset->sitevariable_id)
							<span class="label label-info">Updated</span>
						@endif
						@if($data['insert_id']==$dataset->sitevariable_id)
							<span class="label label-success">New</span>
						@endif							
					</td>
					<td>{{isset($dataset->date_edited)?dateFormat($dataset->date_edited):''}}</td>
					<td class="text-right">
						<div class="btn-group">
							<button type="button" class="btn btn-default" onclick="document.location.href='{{ url('/admin/sitevariable') }}/{{$dataset->sitevariable_id}}'" title="Update"> <span class="fa fa-edit text-warning"></span></button>
						</div>
					</td>
				</tr>
			@endforeach
		</table>
	</div> 
	<div class="box-footer">
		<div class="row">
			<div class="col-sm-6 col-md-6">
				{!! $data['pagenation'] !!}
			</div>
			<div class="col-sm-6 col-md-6 text-right">
				<label class="margin">Record Per Page:</label>
				<select class="form-control page-select" name="recperpage" id="recperpage" onchange="setRecordPerPage('perpage',this.value)">
					<option value="5" @if($data['limit']==5)selected="selected"@endif >5</option>
					<option value="10"@if($data['limit']==10)selected="selected"@endif >10</option>
					<option value="25" @if($data['limit']==25)selected="selected"@endif>25</option>
					<option value="50" @if($data['limit']==50)selected="selected"@endif>50</option>
					<option value="100" @if($data['limit']==100)selected="selected"@endif>100</option>
				</select>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
    {{ Html::script('public/js/bootstrap/bootbox.js') }}
@endsection