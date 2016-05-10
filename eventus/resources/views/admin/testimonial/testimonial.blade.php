@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="testimonial_form" name="testimonial_form" method="POST" class="form-horizontal" enctype="multipart/form-data" action="{{$data['url']}}">
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
                <div class="col-sm-4 col-lg-8"> <input type="text" class="form-control" name="testimonial_name_{{$data['language'][$i]->id}}" id="testimonial_name_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->testimonial_name)?$data['dataset'][$i]->testimonial_name:''}}" required="required"/></div>
                </div> 	
				<div class="form-group">
               		<label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Content <span class="text-red">*</span></label>	
					<div class="col-sm-4 col-lg-8"><textarea id="testimonial_content_{{$data['language'][$i]->id}}" name="testimonial_content_{{$data['language'][$i]->id}}" class="tinymce">{{isset($data['dataset'][$i]->testimonial_content)?$data['dataset'][$i]->testimonial_content:''}}</textarea></div>
					
				</div>			            
                    @endfor
					<div class="form-group">
		               <label class="col-sm-2 text-right"> Created By <span class="text-red">*</span></label>
		                <div class="col-sm-4"> <input type="text" class="form-control" name="created_by" id="created_by" value="{{ isset($data['dataset'][0]->created_by)?$data['dataset'][0]->created_by:''}}" required="required"/></div>
		            </div> 
                    <div class="form-group">
		               <label class="col-sm-2 text-right"> Upload Image</label>
                       <div class="col-sm-10">
					   @if(isset($data['dataset'][0]->testimonial_image))
					   	{{Html::image('public/uploads/testimonial/'.$data['dataset'][0]->testimonial_image, $data['dataset'][0]->testimonial_image)}}
					  @endif	
						   <input type="file" name="testimonial_image"  id="testimonial_image" value="{{isset($data['dataset'][0]->testimonial_image)?$data['dataset'][0]->testimonial_image:''}}" @if($data['todo']=='addrec') required="required" @endif/>
					   <p class="text-danger">Image dimentations <strong>855 x 408</strong>. Image type must be *.jpg, *.jprg, *.png, *.gif. Image Size: Less than <strong>1MB</strong>.</p>
					   </div>
					</div>
                    
                    <div class="form-group">
               <label class="col-sm-2 text-right"> Is Active</label>
                            <div class="col-sm-4">							
                                    <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':'checked="checked"'}} />
                                </div>
                            </div> 
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateTestimonial('{{ url('/admin/testimonial')}}/{{ $data['id']}}','testimonial_form','{{ url('/admin/testimonial_list')}}')"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateTestimonial('{{ url('/admin/testimonial')}}/{{ $data['id']}}','testimonial_form','{{ url('/admin/testimonial_list')}}')"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/testimonial_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
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
	</script>
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection