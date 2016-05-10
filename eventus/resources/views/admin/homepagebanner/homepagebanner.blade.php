@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="homepagebanner_form" name="homepagebanner_form" method="POST" novalidate="novalidate" class="form-horizontal" enctype="multipart/form-data" action="{{$data['url']}}">
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
                <div class="col-sm-4"> <input type="text" class="form-control" name="banner_title_{{$data['language'][$i]->id}}" id="banner_title_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->banner_title)?$data['dataset'][$i]->banner_title:''}}" required="required"/></div>
                </div> 					            
                    @endfor
                    
					<div class="form-group">
		               <label class="col-sm-2 text-right"> Upload Image</label>
                       <div class="col-sm-4">
					       @if(isset($data['dataset'][0]->banner_image))
					   	{{Html::image('public/uploads/banner/'.$data['dataset'][0]->banner_image, $data['dataset'][0]->banner_image, array('width'=>'720'))}}
						<hr/>
					  @endif	
						   <input type="file" name="banner_image" id="banner_image" value="{{isset($data['dataset'][0]->banner_image)?$data['dataset'][0]->banner_image:''}}" @if($data['todo']=='addrec') required="required" @endif/>
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
                                    <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':'checked="checked"'}} />
                    </div>
                </div> 
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateHomePageBanner('{{ url('/admin/homepagebanner')}}/{{ $data['id']}}','homepagebanner_form','{{ url('/admin/homepagebanner_list')}}')"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateHomePageBanner('{{ url('/admin/homepagebanner')}}/{{ $data['id']}}','homepagebanner_form','{{ url('/admin/homepagebanner_list')}}')"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/homepagebanner_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
            </form>            
        </div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection