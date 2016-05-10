@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="subscription_form" name="subscription_form" method="POST" class="form-horizontal">
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
                <div class="col-sm-4"> <input type="text" class="form-control" name="subscription_name_{{$data['language'][$i]->id}}" id="subscription_name_{{$data['language'][$i]->id}}" required="required" value="{{ isset($data['dataset'][$i]->subscription_name)?$data['dataset'][$i]->subscription_name:''}}" maxlength="50" /></div>
                </div> 					            
                    @endfor
                    
					<div class="form-group">
               <label class="col-sm-2 text-right"> Price <span class="text-red">*</span></label>
                            <div class="col-sm-4">							
                                    <input type="text" class="form-control" value="{{isset($data['dataset'][0]->subscription_price)?$data['dataset'][0]->subscription_price:''}}" class="" name="subscription_price" maxlength="10" id="subscription_price" />
                                </div>
                            </div>
							
				<div class="form-group">
               <label class="col-sm-2 text-right"> For Month <span class="text-red">*</span></label>
                            <div class="col-sm-4">						
                                   
								   <select name="subscription_month" id="subscription_month" required="required" class="form-control">
										<option value="">Select Month</option>							
										<option value="3" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==3)?'selected="selected"':'':''}}>3</option>							
										<option value="6" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==6)?'selected="selected"':'':''}}>6</option>
										<option value="12" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==12)?'selected="selected"':'':''}}>12</option>
										<option value="18" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==18)?'selected="selected"':'':''}}>18</option>
										<option value="24" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==24)?'selected="selected"':'':''}}>24</option>
										<option value="30" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==30)?'selected="selected"':'':''}}>30</option>
										<option value="36" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==36)?'selected="selected"':'':''}}>36</option>
										<option value="42" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==42)?'selected="selected"':'':''}}>42</option>
										<option value="48" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==48)?'selected="selected"':'':''}}>48</option>
										<option value="54" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==24)?'selected="selected"':'':''}}>54</option>
										<option value="60" {{isset($data['dataset'][0]->subscription_month)?($data['dataset'][0]->subscription_month==60)?'selected="selected"':'':''}}>60</option>
			                            </select>								    
                                </div>
                            </div>
                    
                    <div class="form-group">
               <label class="col-sm-2 text-right"> Is Active </label>
                            <div class="col-sm-4">							
                                    <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':'checked="checked"'}} />
                                </div>
                            </div> 
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateSubscription('{{ url('/admin/subscription')}}/{{ $data['id']}}','subscription_form','{{ url('/admin/subscription_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateSubscription('{{ url('/admin/subscription')}}','subscription_form','{{ url('/admin/subscription_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/subscription_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
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