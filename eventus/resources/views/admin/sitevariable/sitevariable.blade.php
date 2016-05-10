@extends('layouts.backend')
@section('content')
<div id="main">
	<form id="sitevariable_form" name="sitevariable_form" method="POST" class="form-horizontal" action="{{$data['url']}}">
		<input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
		<input type="hidden" name="id" id="id" value="{{$data['id']}}">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
			</div>
			<div class="box-body">	
				<div class="form-group">
					<label class="col-sm-2 text-right"> Site Variable Key<span class="text-red">*</span></label>
					<div class="col-sm-4"><span>{{$data['dataset'][0]->sitevariable_key}}</span></div>
				</div>				
				@for($i=0; $i < count($data['language']); $i++)
					<div class="form-group">
						<label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Site Variable Value <span class="text-red">*</span></label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="variable_value_{{$data['language'][$i]->id}}" id="variable_value_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->variable_value)?$data['dataset'][$i]->variable_value:''}}" maxlength="50"  />
						</div>
					</div> 					            
				@endfor
			</div>
			<div class="box-footer text-right">
				@if($data['todo']=='saverec')
					<button type="submit" class="btn btn-primary add_more_button add_contact"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
				@else
					<button type="submit" class="btn btn-primary add_more_button add_contact"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
				@endif
				<button type="button" onclick="document.location.href='{{ url('/admin/sitevariable_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
			</div>
		</div>
	</form>            
</div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
	{{ Html::script('public/js/admin/common.js') }}
@endsection