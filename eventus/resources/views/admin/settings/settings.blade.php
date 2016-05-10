@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="settings_form" name="settings_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">      
                @foreach($data['dataGrid'] as $dg)	
					<div class="form-group">
               <label class="col-sm-3 text-right">{{$dg->settings_label}}</label>
                            <div class="col-sm-4">
									<input type="hidden" name="settings_id[]" value="{{$dg->settings_id}}" id="settings_id_{{$dg->settings_id}}"	/>
								@if($dg->settings_type=='T')						
                                    <input type="@if($dg->is_numeric=='Y') number @else text @endif" name="settings[]" id="settings{{$dg->settings_id}}" value="{{$dg->settings_value}}" class="form-control" />
								@elseif($dg->settings_type=='D')									
									<select name="settings[]" id="settings{{$dg->settings_id}}" class="form-control">
										<option></option>
									</select>
								@elseif($dg->settings_type=='C')
									<input type="checkbox" name="settings[]" value="{{$dg->settings_value}}" id="settings{{$dg->settings_id}}"/>
								@endif
                                </div>
                            </div>
							
				@endforeach			
				
            </div>
        	
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updatedata('{{ url('/admin/settings')}}/{{ $data['id']}}','settings_form','{{ url('/admin/settings')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updatedata('{{ url('/admin/settings')}}','settings_form','{{ url('/admin/settings')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/settings') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
            </form>            
        </div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
	{{ Html::script('public/js/admin/common.js') }}
@endsection