@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="content_form" name="content_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">	
				<div class="form-group">
               <label class="col-sm-2 text-right">Content Type <span class="text-red">*</span></label>
                    <div class="col-sm-2">							
                        <select name="content_type" id="content_type" class="form-control" onchange="setTypeContent(this.value)">
							<option value="">Select</option>
							<option value="1" {{isset($data['dataset'][0]->content_type)?($data['dataset'][0]->content_type==1)?'selected="selected"':'':''}} >Page Type</option>
							<option value="2" {{isset($data['dataset'][0]->content_type)?($data['dataset'][0]->content_type==2)?'selected="selected"':'':''}}>Block Type</option>
						</select>
                    </div>
                </div> 				
                    @for($i=0; $i < count($data['language']); $i++)
               
			   <div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Title <span class="text-red">*</span></label>
                <div class="col-sm-4 col-lg-8"> <input type="text" class="form-control" name="cms_title_{{$data['language'][$i]->id}}" id="cms_title_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->cms_title)?$data['dataset'][$i]->cms_title:''}}" /></div>
                </div>
				<div class="form-group">
						<label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Content <span class="text-red">*</span></label>
						<div class="col-sm-4 col-lg-8"><textarea id="cms_content_{{$data['language'][$i]->id}}" name="cms_content_{{$data['language'][$i]->id}}" class="tinymce">{{isset($data['dataset'][$i]->cms_content)?$data['dataset'][$i]->cms_content:''}}</textarea></div>
				</div>
				<div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Meta Title <span class="text-red">*</span></label>
                <div class="col-sm-4 col-lg-8"> <input type="text" class="form-control" name="meta_title_{{$data['language'][$i]->id}}" id="meta_title_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->meta_title)?$data['dataset'][$i]->meta_title:''}}" {{isset($data['dataset'][0]->content_type)?($data['dataset'][0]->content_type==2)?'disabled="disabled"':'':''}} /></div>
                </div>
				<div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Meta Description</label>
                <div class="col-sm-4 col-lg-8"> <input type="text" class="form-control" name="meta_description_{{$data['language'][$i]->id}}" id="meta_description_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->meta_description)?$data['dataset'][$i]->meta_description:''}}" {{isset($data['dataset'][0]->content_type)?($data['dataset'][0]->content_type==2)?'disabled="disabled"':'':''}} /></div>
                </div>
				<div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Meta Keyword</label>
                <div class="col-sm-4 col-lg-8"> <input type="text" class="form-control" name="meta_keyword_{{$data['language'][$i]->id}}" id="meta_keyword_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->meta_keyword)?$data['dataset'][$i]->meta_keyword:''}}"  {{isset($data['dataset'][0]->content_type)?($data['dataset'][0]->content_type==2)?'disabled="disabled"':'':''}} /></div>
                </div>
                    @endfor
					
                    
					
                    
					 
                    <!--<div class="form-group">
               <label class="col-sm-2 text-right"> Is Active</label>
                            <div class="col-sm-4">							
                                    <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':'checked="checked"'}} />
                                </div>
                            </div> -->
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateContent('{{ url('/admin/content')}}/{{ $data['id']}}','content_form','{{ url('/admin/content_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateContent('{{ url('/admin/content')}}','content_form','{{ url('/admin/content_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/content_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
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
		 function setTypeContent(id){
		 	if(id==1){
				$('#meta_title_1').removeAttr("disabled");
				$('#meta_description_1').removeAttr("disabled");
				$('#meta_keyword_1').removeAttr("disabled");
				$('#meta_title_2').removeAttr("disabled");
				$('#meta_description_2').removeAttr("disabled");
				$('#meta_keyword_2').removeAttr("disabled");
			}else{
				$('#meta_title_1').attr("disabled");
				$('#meta_description_1').attr("disabled");
				$('#meta_keyword_1').attr("disabled");
				$('#meta_title_2').attr("disabled");
				$('#meta_description_2').attr("disabled");
				$('#meta_keyword_2').attr("disabled");
			}
		 }
	</script>
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection