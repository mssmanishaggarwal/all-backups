@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="addon_form" name="addon_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">					
                    @for($i=0; $i < count($data['language']); $i++)
                    <div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Name <span class="text-red">*</span></label>
                <div class="col-sm-4"> <input type="text" class="form-control" name="addon_name_{{$data['language'][$i]->id}}" id="addon_name_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->addon_name)?$data['dataset'][$i]->addon_name:''}}" maxlength="50" /></div>
                </div> 					            
                    @endfor
                    
                    
                    <div class="form-group">
               <label class="col-sm-2 text-right"> Is Active</label>
                            <div class="col-sm-4">							
                                    <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':'checked="checked"'}} />
                                </div>
                            </div> 
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateAddon('{{ url('/admin/addon')}}/{{ $data['id']}}','addon_form','{{ url('/admin/addon_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateAddon('{{ url('/admin/addon')}}','addon_form','{{ url('/admin/addon_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/addon_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
                  </div>
                </div>
            </form>            
        </div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
	{{ Html::script('public/js/admin/common.js') }}
@endsection