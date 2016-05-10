@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="user_form" name="user_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">					
                    <!--<div class="form-group">
               			<label class="col-sm-2 text-right">User Type <span class="text-red">*</span></label>
						<div class="col-sm-4">
							<select  class="form-control" name="user_type" id="user_type">
	                    		<option value="">Select User Type</type>
	                    		<option value="U" {{isset($data['dataset'][0]->user_type)?($data['dataset'][0]->user_type=='U')?'selected="selected"':'':''}}>User</type>
	                    		<option value="O" {{isset($data['dataset'][0]->user_type)?($data['dataset'][0]->user_type=='O')?'selected="selected"':'':''}}>Owner</type>
							</select>
							</div>
						</div>-->
                	 					                                
					<div class="form-group">
               			<label class="col-sm-2 text-right">Email <span class="text-red">*</span></label>
                		<div class="col-sm-4"> <input type="email" class="form-control" name="email" id="email" value="{{isset($data['dataset'][0]->email)?$data['dataset'][0]->email:''}}" {{isset($data['dataset'][0]->email)?'readonly="readonly" disabled="disabled"':''}} maxlength="50" />
                		<p class="duplicate_email"></p>
                		</div>
                		
                	</div> 					            
                   
					 <div class="form-group" style="{{isset($data['dataset'][0]->id)?'display:none;':''}}">
               			<label class="col-sm-2 text-right">Password <span class="text-red">*</span></label>
                		<div class="col-sm-4"> <input type="text" {{isset($data['dataset'][0]->id)?'readonly="readonly" disabled="disabled"':''}} class="form-control" name="password" id="password" value="{{isset($data['dataset'][0]->password)?$data['dataset'][0]->password:''}}" maxlength="50" /></div>
                	</div> 
					
					 <div class="form-group">
               			<label class="col-sm-2 text-right">First Name <span class="text-red">*</span></label>
                		<div class="col-sm-4"> <input type="text" class="form-control" name="first_name" id="first_name" value="{{isset($data['dataset'][0]->first_name)?$data['dataset'][0]->first_name:''}}" maxlength="50" /></div>
                	</div> 
					
					 <div class="form-group">
               			<label class="col-sm-2 text-right">Last Name <span class="text-red">*</span></label>
                		<div class="col-sm-4"> <input type="text" class="form-control" name="last_name" id="last_name" value="{{isset($data['dataset'][0]->last_name)?$data['dataset'][0]->last_name:''}}" maxlength="50" /></div>
                	</div> 
					
					 <div class="form-group">
               			<label class="col-sm-2 text-right">Mobile No. <span class="text-red">*</span></label>
                		<div class="col-sm-4"> <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{isset($data['dataset'][0]->contact_number)?$data['dataset'][0]->contact_number:''}}" {{isset($data['dataset'][0]->contact_number)?'readonly="readonly" disabled="disabled"':''}} maxlength="50" />
                		<p class="duplicate_password"></p>
                		</div>
                		
                	</div> 
					
					 <div class="form-group">
               			<label class="col-sm-2 text-right">Address <span class="text-red">*</span></label>
                		<div class="col-sm-4"> 
						
						
						<input type="text" class="form-control" id="address" name="address" value="{{isset($data['dataset'][0]->address)?$data['dataset'][0]->address:''}}" maxlength="50" /></div>
                	</div>
					
					<div class="form-group">
               			<label class="col-sm-2 text-right">Location<span class="text-red">*</span></label>
                		<div class="col-sm-4"> 
						<select class="form-control" id="city" name="city">
						 	<option value="">Select</option>
							@foreach($data['city'] as $ct)
								<option {{isset($data['dataset'][0]->city)?($data['dataset'][0]->city==$ct->location_id)?'selected':'':''}} value="{{$ct->location_id}}">{{$ct->location_name}}</option>
							@endforeach
						 </select>
						</div>
                	</div>
					
					<div class="form-group">
               			<label class="col-sm-2 text-right">Province <span class="text-red">*</span></label>
                		<div class="col-sm-4"> 
						 <select class="form-control" id="state" name="state">
						 	<option value="">Select</option>
							@foreach($data['state'] as $st)
								<option {{isset($data['dataset'][0]->state)?($data['dataset'][0]->state==$st->id)?'selected':'':''}} value="{{$st->id}}">{{$st->province_name}}</option>
							@endforeach
						 </select></div>
                	</div> 
					
					<!--<div class="form-group">
               			<label class="col-sm-2 text-right">County <span class="text-red">*</span></label>
                		<div class="col-sm-4"> <input type="text" id="country" name="country" class="form-control" name="user_content" value="AO" readonly="readonly" disabled="disabled" maxlength="50" /></div>
                	</div>-->
					
					<div class="form-group">
               			<label class="col-sm-2 text-right">Postcode </label>
                		<div class="col-sm-4"> <input type="text" class="form-control" id="postcode" name="postcode" value="{{isset($data['dataset'][0]->postcode)?$data['dataset'][0]->postcode:''}}" maxlength="50" /></div>
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
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateUser('{{ url('/admin/user')}}/{{ $data['id']}}','user_form','{{ url('/admin/user_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateUser('{{ url('/admin/user')}}','user_form','{{ url('/admin/user_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/user_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
                  </div>
                </div>
            </form>            
        </div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection