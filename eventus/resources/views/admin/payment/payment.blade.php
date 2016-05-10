@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="payment_form" name="payment_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">
                <div class="form-group">
	                <label class="col-sm-2 text-right">Payment Number: </label>
	                <div class="col-sm-4"><span>{{$data['dataset'][0]->payment_number}}</span></div>
                </div>
                
                <div class="form-group">
	                <label class="col-sm-2 text-right">Transaction Id: </label>
	                <div class="col-sm-4"><span>{{$data['dataset'][0]->transaction_id}}</span></div>
                </div>
                
                <div class="form-group">
	                <label class="col-sm-2 text-right">Payment By: </label>
	                <div class="col-sm-4"><span>{{$data['dataset'][0]->first_name}} {{$data['dataset'][0]->last_name}}</span></div>
                </div>
                
                <div class="form-group">
	                <label class="col-sm-2 text-right">Payment For: </label>
	                <div class="col-sm-4"><span>
	                @if($data['dataset'][0]->payment_for == 'B')
					Booking							
					@elseif($data['dataset'][0]->payment_for == 'S')
					Subscription							
					@elseif($data['dataset'][0]->payment_for == 'F')
					Featured
					@else
					--
					@endif	                
	                </span></div>
                </div>
                
                <div class="form-group">
	                <label class="col-sm-2 text-right">Amount: </label>
	                <div class="col-sm-4"><span>{{$data['dataset'][0]->payment_amount}} (AOA)</span></div>
                </div>          
                
                
                <div class="form-group">
	                <label class="col-sm-2 text-right">Payment Date: </label>
	                <div class="col-sm-4">
	                <input type="text" class="form-control datepicker" name="payment_date" id="payment_date" value="{{ isset($data['dataset'][0]->payment_date)?dateFormatDB($data['dataset'][0]->payment_date):''}}" required="required"/>
	                </div>
                </div>
                
                <div class="form-group">
	                <label class="col-sm-2 text-right">Payment Status: </label>
	                <div class="col-sm-4">
	                	<select  class="form-control" name="payment_status" id="payment_status">
	                    		<option value="S" {{isset($data['dataset'][0]->payment_status)?($data['dataset'][0]->payment_status=='P')?'selected="selected"':'':''}}>Success</option>
	                    		<option value="F" {{isset($data['dataset'][0]->payment_status)?($data['dataset'][0]->payment_status=='F')?'selected="selected"':'':''}}>Failed</option>
	                    		<option value="P" {{isset($data['dataset'][0]->payment_status)?($data['dataset'][0]->payment_status=='P')?'selected="selected"':'':''}}>Pending</option>
						</select>
	                </div>
                </div>
                </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateAccommodation('{{ url('/admin/payment')}}/{{ $data['id']}}','payment_form','{{ url('/admin/payment_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateAccommodation('{{ url('/admin/payment')}}','payment_form','{{ url('/admin/payment_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/payment_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
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