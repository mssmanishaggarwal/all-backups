@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="innerpagebanner_form" name="innerpagebanner_form" method="POST" novalidate="novalidate" class="form-horizontal" enctype="multipart/form-data" action="{{$data['url']}}">
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
                <div class="col-sm-4"> <input type="text" class="form-control" name="inner_banner_title_{{$data['language'][$i]->id}}" id="inner_banner_title_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->inner_banner_title)?$data['dataset'][$i]->inner_banner_title:''}}" required="required"/></div>
                </div> 					            
                    @endfor
					
                    <div class="form-group">
		               <label class="col-sm-2 text-right"> Upload Image</label>
                       <div class="col-sm-4">
					   @if(isset($data['dataset'][0]->inner_banner_image))
					   	{{Html::image('public/uploads/inner_banner/'.$data['dataset'][0]->inner_banner_image, $data['dataset'][0]->inner_banner_image, array('width'=>'720'))}}
						<hr/>
					  @endif	
						   <input type="file" name="inner_banner_image" id="inner_banner_image" value="{{isset($data['dataset'][0]->inner_banner_image)?$data['dataset'][0]->inner_banner_image:''}}" @if($data['todo']=='addrec') required="required" @endif/>
					   </div>
					</div>
	
					<div class="form-group">
		               <label class="col-sm-2 text-right">Content <span class="text-red">*</span></label>
                       <div class="col-sm-4">
						   <select id="cms_id" name="cms_id" class="form-control" >
						   		@foreach( $data['content'] as $cms )
									<option {{isset($data['dataset'][0]->cms_id)?$data['dataset'][0]->cms_id == $cms->cms_id?'selected="selected"':'':''}} value="{{$cms->cms_id}}">{{$cms->cms_title}}</option>
								@endforeach
						   </select>
					   </div>
					</div>
					<div class="form-group">
		               <label class="col-sm-2 text-right">Province <span class="text-red">*</span></label>
                       <div class="col-sm-4">
						   <select id="province_id" name="province_id" class="form-control" >
						   		@foreach( $data['province'] as $pro )
									<option {{isset($data['dataset'][0]->province_id)?$data['dataset'][0]->province_id == $pro->id?'selected="selected"':'':''}} value="{{$pro->id}}">{{$pro->province_name}}</option>
								@endforeach
						   </select>
					   </div>
					</div>
					<div class="form-group">
		               <label class="col-sm-2 text-right">Location <span class="text-red">*</span></label>
                       <div class="col-sm-4">
						   <select id="location_id" name="location_id" class="form-control" >
						   		@foreach( $data['location'] as $pro )
									<option {{isset($data['dataset'][0]->location_id)?$data['dataset'][0]->location_id == $pro->location_id?'selected="selected"':'':''}} value="{{$pro->location_id}}">{{$pro->location_name}}</option>
								@endforeach
						   </select>
					   </div>
					</div>
					
					
					
					
					
					<div class="form-group">
		               <label class="col-sm-2 text-right"> Publish date <span class="text-red">*</span></label>
                       <div class="col-sm-4">
					   		<input type="date" class="form-control datepicker" id="publish_date" name="publish_date" value="{{isset($data['dataset'][0]->publish_date)?$data['dataset'][0]->publish_date:''}}" readonly="readonly" />
					   </div>
					  </div>
					  <div class="form-group">
		               <label class="col-sm-2 text-right"> Expiry date <span class="text-red">*</span></label>
                       <div class="col-sm-4">
					   		<input type="date" class="form-control datepicker" id="expiry_date" name="expiry_date" value="{{isset($data['dataset'][0]->expiry_date)?$data['dataset'][0]->expiry_date:''}}" readonly="readonly" />
					   </div>
					  </div>
					  
					  
					  
					  
					  
					  
                    <div class="form-group">
               <label class="col-sm-2 text-right"> Is Active</label>
                            <div class="col-sm-4">							
                                    <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':1}} />
                                </div>
                            </div> 
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/innerpagebanner_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
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