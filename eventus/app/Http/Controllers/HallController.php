<?php

namespace App\Http\Controllers;
use App\Helper\Languagehelper;
use App\Models\Common;
use DB;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

class HallController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//$this->middleware('auth');
	}
	public function languageSetter(Request $request) {
		$data = array();
		/* SET DEFAULT LANGUAGE START */
		$data['languages'] = Languagehelper::getLanguage();
		$data['default_language'] = Languagehelper::getDefaultLanguage();

		$language_id = $request->session()->get('language_id');
		if (empty($language_id)) {
			$request->session()->put('language_id', $data['default_language']);
			$data['language_val'] = $data['default_language'];
			$data['currentlanguages'] = $data['default_language'];

		} else {
			$data['language_val'] = $language_id;
			$data['currentlanguages'] = $language_id;
		}
		$data['secondary_header'] = 0;
		return $data;
	}

	public function index($id, Request $request) {
		$data = $this->languageSetter($request);	
		
		$id = base64_decode($id);
		$data['hallDetails'] = Common::hallDetails($data['language_val'],$id);
		$data['hallImage'] = Common::hallImage($id);
		$data['hallAddon'] = Common::hallAddon($data['language_val'],$id);
		$data['hallReview'] = Common::hallReview($id);
		$data['hallAccommodation'] = Common::hallAccommodation($data['language_val'],$id);
		$data['hallType'] = Common::hallTypeDetails($data['language_val'],$id);		
		$data['hallFacilities'] = Common::hallFacilities($data['language_val'],$id);
		if($data['hallDetails']->lat != '' && $data['hallDetails']->lng != '')
		$data['hallSimilar'] = Common::hallSimilar($data['language_val'],$data['hallDetails']->lat,$data['hallDetails']->lng,$id);
		else
		$data['hallSimilar'] = array();
		//dd($data['hallSimilar']);
		// for rating calculation start //
		$totalRating = 0;
		$totalRatedby = 0;		
		foreach($data['hallReview'] as $review)
		{
			if($review->review_rating > 0)
			{
				$totalRating += $review->review_rating;
				$totalRatedby++;
			}				
		}
	  	if($totalRatedby>0)
		$data['ratePercentage'] = $totalRating / $totalRatedby;
		else
		$data['ratePercentage'] = 0;
		// for rating end //
		
		//dd($request->session()->get('_previous')['url']);
		
		// For breadcrumb start //		
		$breadcrumbArray = $request->session()->get('breadcrumb');
		unset($breadcrumbArray['Booking']);
		if(count($breadcrumbArray) == 0)
		$breadcrumbArray['Home'] = url('/');
						
		$breadcrumbArray[$data['hallDetails']->hall_name] = '';
		$request->session()->put('breadcrumb', $breadcrumbArray);
		$data['breadcrumb'] = $request->session()->get('breadcrumb');
		// For breadcrumb end //	
			
		return view('hall.index', ['data' => $data]);
	}
	
	public function showbook(Request $request)
	{
		if(Auth::user()->id && Input::get('book_hall_id'))
		{
			$data = $this->languageSetter($request);
			$data['secondary_header'] = 1;
			$book_hall_id = Input::get('book_hall_id');			
			$checkin_date = Input::get('checkin_date');
			$checkout_date = Input::get('checkout_date');
			$datediff = strtotime(dateFormatDB($checkout_date))-strtotime(dateFormatDB($checkin_date));
			$totalDay = floor($datediff/(60*60*24)) + 1;
			
			$hall_addon= Input::get('hall_addon');
			
			$data['hallDetails'] = Common::hallDetails($data['language_val'],$book_hall_id);
			$data['userDetails'] = Common::getUser(Auth::user()->id);
			$data['locationList'] = Common::getLocation($data['language_val']);
			$data['subTotal'] = 0;
			if(count($hall_addon))
			{
				$data['hallAddon'] = Common::getBookAddon($data['language_val'],$hall_addon,$book_hall_id);
				
				foreach($data['hallAddon'] as $addon)
				{
					$data['subTotal'] += $addon->addon_price;
				}
				
				$data['subTotal'] = $data['subTotal'] +  $data['hallDetails']->rental_amount;
			}			
			else
			{
				$data['hallAddon'] = array();
				$data['subTotal'] = $data['hallDetails']->rental_amount;
			}
			$data['total'] = $data['subTotal'] * $totalDay;
			$data['hallDetails']->checkin_date = $checkin_date;
			$data['hallDetails']->checkout_date = $checkout_date;
			$data['totalday'] = $totalDay;
			
			//$book = array();
			$request->session()->put('book_hall_id', $book_hall_id);
			$request->session()->put('checkin_date', $checkin_date);
			$request->session()->put('checkout_date', $checkout_date);
			$request->session()->put('total_amount', $data['total']);
			$request->session()->put('hall_addon', $data['hallAddon']);
			//dd($data['hallAddon']);
			
				
			$breadcrumbArray = $request->session()->get('breadcrumb');			
			$breadcrumbArray[$data['hallDetails']->hall_name] = url('/hall').'/'.base64_encode($book_hall_id);
			$breadcrumbArray['Booking'] = '';
			$request->session()->put('breadcrumb', $breadcrumbArray);
			$data['breadcrumb'] = $request->session()->get('breadcrumb');
			
			return view('hall.booking', ['data' => $data]);
		}
		
	}
	
	public function updatebook(Request $request)
	{
		$data = $this->languageSetter($request);
		
		$book_hall_id = $request->session()->get('book_hall_id');
		$booking_number = 'EA-'.Auth::user()->id.'-'.$book_hall_id.'-'.time();
		
		$book_checkin_date = $request->session()->get('checkin_date');
		$book_checkout_date = $request->session()->get('checkout_date');
		$hall_addon = $request->session()->get('hall_addon');
		$total_amount = $request->session()->get('total_amount');
		$data['userDetails'] = Common::getUser(Auth::user()->id);
		$data['hallDetails'] = Common::hallDetails($data['language_val'],$book_hall_id);
		//dd($data['hallDetails']);
		
		$bookingid = DB::table('booking')->insertGetId(
				['booking_number' => $booking_number,
				 'user_id' => Auth::user()->id,
	    		 'user_first_name' => $data['userDetails']->first_name,
	    		 'user_last_name' => $data['userDetails']->last_name,
	    		 'user_email' => $data['userDetails']->email,
	    		 'user_contact' => $data['userDetails']->contact_number,    		 
	    		 'hall_id' => $book_hall_id,    		 
	    		 'hall_name' => $data['hallDetails']->hall_name,    		 
	    		 'hall_location_name' => $data['hallDetails']->location_name,  		 
	    		 'hall_province_name' => $data['hallDetails']->province_name,    		 
	    		 'booking_first_name' => Input::get('first_name'),    		 
	    		 'booking_last_name' => Input::get('last_name'), 		 
	    		 'booking_email' => Input::get('email'),    		 
	    		 'booking_contact_number' => Input::get('contact_number'),    		 
	    		 'booking_address' => Input::get('address'),    		 
	    		 'booking_city' => Input::get('city'),    		 
	    		 'booking_postcode' => Input::get('postcode'),    		 
	    		 'special_comment' => Input::get('comment'),    		 
	    		 'check_in' => dateFormatDB($book_checkin_date),    		 
	    		 'check_out' => dateFormatDB($book_checkout_date),    		 
	    		 'rental_amount' =>  $data['hallDetails']->rental_amount,    		 
	    		 'booking_amount' => $total_amount,    		 
	    		 'booking_datetime' => date('Y-m-d H:i:s')]
		);		
		
		if($bookingid)
		{
			DB::table('payments')->insert(
					['payment_number' => uniqid(),
					 'payment_date' => date('Y-m-d H:i:s'),
					 'payment_amount' => $total_amount,
					 'payment_for' => 'B',
					 'payment_for_id' => $bookingid,
					 'payment_by_id' => Auth::user()->id]					
					);
			
			foreach($hall_addon as $addon)
			{
				DB::table('book_addon')->insert(
					['booking_id' => $bookingid, 'addon_id' => $addon->addon_id, 'addon_name' => $addon->addon_name, 'addon_price' => $addon->addon_price]
				);
			}
			
			$request->session()->put('bookingid',$bookingid);	
			$request->session()->put('hall_name',$data['hallDetails']->hall_name);	
			$request->session()->put('booking_amount',$total_amount);	
			$request->session()->put('booking_email',Input::get('email'));	
			return redirect('/payment')->with('status','Your booking has been made!');
		}
		
		
	}
	
	public function payment(Request $request)
	{
		if(Auth::check())
		{
			$data = $this->languageSetter($request);
			$changeRate = DB::table('settings')->where('settings_id', 16)->pluck('settings_value');
			$data['book_hall_id'] = $request->session()->get('book_hall_id');
			$data['bookingid'] = $request->session()->get('bookingid');
			$data['hall_name'] = $request->session()->get('hall_name');
			$data['booking_amount'] = number_format($request->session()->get('booking_amount') * $changeRate[0],2);
			$data['returnUrl'] = url('/thanks-hall');
			$data['secondary_header'] = 1;
			return view('hall.payment', ['data' => $data]);
		}
		else
		return redirect('/');
		
	}
	
	public function paymentThanks(Request $request)
	{
		$data = $this->languageSetter($request);
		$data['booking_email'] = $request->session()->get('booking_email');;
		$payment_datetime = dateTimeFormatDB(Input::get('payment_date'));
		$payment_status = Input::get('payment_status');
		$booking_status = 0;		
		if($payment_status=='Success')
		{
			$payment_status = 'S';
			$booking_status = 1;
		}
		else if($payment_status=='Failed')
		$payment_status = 'F';
		else
		{
			$payment_status = 'P';
			$booking_status = 3;
		}
		
		
		$txn_id = Input::get('txn_id');
		$custom = Input::get('custom');
		//dd($request);
		
		DB::table('booking')
            ->where('booking_id', $custom)
            ->update(['booking_status' => $booking_status]);
        
        DB::table('payments')
            ->where('payment_for_id', $custom)
            ->where('payment_for', 'B')
            ->update(['transaction_id' => $txn_id,
            		  'payment_date' => $payment_datetime,
            		  'payment_status' => $payment_status
            		]);        
       
        $bookingid = $request->session()->get('bookingid');
        $bookingDetails = Common::getBookingdata($bookingid);
        	   		 
        // Email section start //
        $username = Auth::user()->first_name;     
		$emailTemplate = Common::getEmaildata(2,$data['language_val']);	
		$data['email_subject'] = $emailTemplate->email_subject;
		$headerText = $emailTemplate->email_body;
		$headerText = str_replace('[USERNAME]',$username,$headerText);
		$headerText = str_replace('[HALL_NAME]',$bookingDetails->hall_name,$headerText);
		$headerText = str_replace('[LOCATION]',$bookingDetails->hall_location_name.', '.$bookingDetails->hall_province_name,$headerText);
		$headerText = str_replace('[CHECKIN]',dateFormat($bookingDetails->check_in),$headerText);
		$headerText = str_replace('[CHECKOUT]',dateFormat($bookingDetails->check_out),$headerText);
		
		$data['body'] = $headerText;
		
				
		//return view('emails.email_template', ['data' => $data]);
		Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
			$fromEmail = Common::getSettingdata(2);			
			$message->from($fromEmail, 'Eventus Angola');
			$message->to(Auth::user()->email)->subject($data['email_subject']);
		});
        // Email section end //       
                
        $data['payment_status']	= $payment_status;	
        $data['secondary_header'] = 1;
		return view('hall.thanks', ['data' => $data]);
	}

	

}
