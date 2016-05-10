@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="faq_form" name="faq_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">					
                    @for($i=0; $i < count($data['language']); $i++)
                    <div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Title <span class="text-red">*</span></label>
                <div class="col-sm-8"> <input type="text" class="form-control" name="faq_title_{{$data['language'][$i]->id}}" id="faq_title_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->faq_title)?$data['dataset'][$i]->faq_title:''}}" maxlength="50" /></div>
                </div> 		
				 <div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Content <span class="text-red">*</span></label>		
			   <div class="col-sm-4 col-lg-8"><textarea id="faq_content_{{$data['language'][$i]->id}}" name="faq_content_{{$data['language'][$i]->id}}" class="tinymce">{{isset($data['dataset'][$i]->faq_content)?$data['dataset'][$i]->faq_content:''}}</textarea></div>
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
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateFAQ('{{ url('/admin/faq')}}/{{ $data['id']}}','faq_form','{{ url('/admin/faq_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateFAQ('{{ url('/admin/faq')}}','faq_form','{{ url('/admin/faq_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/faq_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
            </form>            
        </div>
@endsection
@section('script')
	<script>
		tinymce.init({
		  selector: 'textarea',
		  height: 150,
		  forced_root_block : '',
		 });
	</script>
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection