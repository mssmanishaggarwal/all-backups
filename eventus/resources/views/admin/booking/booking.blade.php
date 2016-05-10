@extends('layouts.backend')
@section('content')
        <div id="main">
            <form id="booking_form" name="booking_form" method="POST" class="form-horizontal" action="{{$data['url']}}">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">					
                    <div class="form-group">
						<label class="col-sm-2 text-right"> Booking Number</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_number }}
							</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-2 text-right"> User Name</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->user_first_name.' '.$data['dataset'][0]->user_last_name }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> User Email</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->user_email }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> User Contact</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->user_contact }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Hall Name</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->hall_name }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Hall Location Name</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->hall_location_name }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Hall Province Name</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->hall_province_name }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Name</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_first_name.' '.$data['dataset'][0]->booking_last_name }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Email</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_email }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Contact No.</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_contact_number }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Address</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_address }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking City</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_city }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Postcode</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_postcode }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Special Comment</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->special_comment }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Check in</label>
							<div class="col-sm-4">
								{{ isset($data['dataset'][0]->check_in)?dateFormat($data['dataset'][0]->check_in):'' }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Check out</label>
							<div class="col-sm-4">
								{{ isset($data['dataset'][0]->check_out)?dateFormat($data['dataset'][0]->check_out):'' }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Rental Amount</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->rental_amount }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Amount</label>
							<div class="col-sm-4">
								{{ $data['dataset'][0]->booking_amount }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Date & Time</label>
							<div class="col-sm-4">
								{{ isset($data['dataset'][0]->booking_datetime)?dateTimeFormat($data['dataset'][0]->booking_datetime):'' }}
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 text-right"> Booking Status</label>
							<div class="col-sm-4">
								<select name="booking_status" id="booking_status" class="form-control">
									@foreach($data['status_array'] as $key => $each_status)
									<option value="{{$key}}" {{isset($data['dataset'][0]->booking_status)?($data['dataset'][0]->booking_status==$key)?'selected="selected"':'':''}} >{{$each_status}}</option>
									@endforeach
								</select>
							</div>
					</div>
										
            </div>
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact"><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
              <button type="button" onclick="document.location.href='{{ url('/admin/booking_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
            </form>            
        </div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
	{{ Html::script('public/js/admin/common.js') }}
@endsection