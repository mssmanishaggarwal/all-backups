@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="review_form" name="review_form" method="POST" class="form-horizontal" enctype="multipart/form-data" action="{{$data['url']}}">
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
                <div class="col-sm-4"> <input type="text" class="form-control" name="review_title_{{$data['language'][$i]->id}}" id="review_title_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->review_title)?$data['dataset'][$i]->review_title:''}}" required="required"/></div>
                </div> 					            
                    @endfor
                    
                    <div class="form-group">
		               <label class="col-sm-2 text-right"> Upload Image</label>
                       <div class="col-sm-10">
					   		@if(isset($data['dataset'][0]->review_image))
					   	{{Html::image('public/uploads/review/'.$data['dataset'][0]->review_image, $data['dataset'][0]->review_image)}}
					  @endif	
						   <input type="file" name="review_image" id="review_image" value="{{isset($data['dataset'][0]->review_image)?$data['dataset'][0]->review_image:''}}" @if($data['todo']=='addrec') required="required" @endif/>
					   <p class="text-danger">Image dimentations <strong>855 x 408</strong>. Image type must be *.jpg, *.jprg, *.png, *.gif. Image Size: Less than <strong>1MB</strong>.</p>
					   </div>
					</div>
					
					<div class="form-group">
		               <label class="col-sm-2 text-right">Position <span class="text-red">*</span></label>
                       <div class="col-sm-4">	
						   <select id="position_id" name="position_id" class="form-control" >
						   		@foreach( $data['position'] as $pos )
									<option {{isset($data['dataset'][0]->position_id)?$data['dataset'][0]->position_id == $pos->id?'selected="selected"':'':''}} value="{{$pos->id}}">{{$pos->position_name}}</option>
								@endforeach
						   </select>
					   </div>
					</div>
					<div class="form-group">
		               <label class="col-sm-2 text-right"> Review Link <span class="text-red">*</span></label>
                       <div class="col-sm-4">
					   		<input type="text" class="form-control" id="review_link" name="review_link" value="{{isset($data['dataset'][0]->review_link)?$data['dataset'][0]->review_link:''}}" />
					   </div>
					  </div>
					<div class="form-group">
		               <label class="col-sm-2 text-right"> Start date <span class="text-red">*</span></label>
                       <div class="col-sm-4">
					   		<input type="date" class="form-control datepicker" id="start_date" name="start_date" value="{{isset($data['dataset'][0]->start_date)?$data['dataset'][0]->start_date:''}}" readonly="readonly" />
					   </div>
					  </div>
					  <div class="form-group">
		               <label class="col-sm-2 text-right"> End date <span class="text-red">*</span></label>
                       <div class="col-sm-4">
					   		<input type="date" class="form-control datepicker" id="end_date" name="end_date" value="{{isset($data['dataset'][0]->end_date)?$data['dataset'][0]->end_date:''}}" readonly="readonly" />
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
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateReview('{{ url('/admin/review')}}/{{ $data['id']}}','review_form','{{ url('/admin/review_list')}}')"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateReview('{{ url('/admin/review')}}/{{ $data['id']}}','review_form','{{ url('/admin/review_list')}}')"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/review_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
            </form>            
        </div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection