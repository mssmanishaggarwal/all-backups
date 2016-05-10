@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="email_form" name="email_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">	
					<div class="form-group">
		               <label class="col-sm-2 text-right">Template Title <span class="text-red">*</span></label>
		                <div class="col-sm-8"> <input type="text" class="form-control" name="email_title" id=email_title" value="{{ isset($data['dataset'][0]->email_title)?$data['dataset'][0]->email_title:''}}" required="required"/></div>
               		 </div>			
                    @for($i=0; $i < count($data['language']); $i++)                    
					   
					 <div class="form-group">
		               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Mail subject <span class="text-red">*</span></label>
					  <div class="col-sm-8"> <input type="text" class="form-control" name="email_subject_{{$data['language'][$i]->id}}" id="email_subject_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->email_subject)?$data['dataset'][$i]->email_subject:''}}" required="required"/></div>
					  </div>
					  <div class="form-group">
		               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Mail body <span class="text-red">*</span></label>
					   <div class="col-sm-4 col-lg-8"><textarea id="email_body_{{$data['language'][$i]->id}}" name="email_body_{{$data['language'][$i]->id}}" class="tinymce">{{isset($data['dataset'][$i]->email_body)?$data['dataset'][$i]->email_body:''}}</textarea></div>
					  </div>
					  
		                      
                    @endfor
                    
                    
                    <!--<div class="form-group">
	               		<label class="col-sm-2 text-right"> Is Active</label>
	                	<div class="col-sm-4">							
	                        <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':'checked="checked"'}} />
	                    </div>
               		</div>	-->
					
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateEmail('{{ url('/admin/email')}}/{{ $data['id']}}','email_form','{{ url('/admin/email_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateEmail('{{ url('/admin/email')}}','email_form','{{ url('/admin/email_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/email_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
                  </div>
                </div>
            </form>            
        </div>
@endsection
@section('script')
	<script>
		tinymce.init({
		  selector: 'textarea',
		  height: 250,
		  forced_root_block : '',
		});
		$(function() {
			$('#email_extra').click(function(){
				$('.extra-template').toggle();

			});
		});
	</script>
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
	{{ Html::script('public/js/admin/common.js') }}
@endsection