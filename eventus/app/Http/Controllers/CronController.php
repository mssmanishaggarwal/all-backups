<?php

namespace App\Http\Controllers;
use App\Helper\Languagehelper;
use App\Models\Common;
use Response;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Mail;

class CronController extends Controller {
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

	public function index(Request $request) {
				
		$data = $this->languageSetter($request);
		
		$beforeExpiry = Common::getSettingdata(17);		
		$afterExpiry = Common::getSettingdata(18);
		$daysInterval = Common::getSettingdata(19);
		
		//// Renew mail to user, before expiry date start ////
		
		$renewBefore = DB::select(
					 DB::raw('SELECT hsr.*, DATEDIFF(hsr.expiry_date,CURDATE()) as duration, u.first_name, u.email, ht.hall_name
					 		FROM ev_hall_subscription_relation as hsr
					 		inner join ev_hall as h ON hsr.hall_id = h.id
					 		inner join ev_hall_translation as ht ON ht.hall_id = h.id
					 		inner join ev_users as u on h.user_id = u.id
					 		where DATEDIFF(hsr.expiry_date,CURDATE()) <= '.$beforeExpiry.' and DATEDIFF(hsr.expiry_date,CURDATE()) >= 1
					 		and hsr.payment_status = "1"
					 		and h.is_active = "1"
					 		and u.is_active = "1"
					 		and ht.language_id = 1
							'));	
		
		foreach($renewBefore as $renew)
		{
			$duration = $renew->duration;
			if($duration == 30 || $duration == 23 || $duration == 16 || $duration == 9 || $duration == 1){
			// Email section start //
			$username = $renew->first_name;
			$emailTemplate = Common::getEmaildata(11, $data['language_val']);
			$data['email_subject'] = $emailTemplate->email_subject;
			$headerText = $emailTemplate->email_body;
			$headerText = str_replace('[USERNAME]', $username, $headerText);			
			$headerText = str_replace('[HALL_NAME]', $renew->hall_name, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_NAME]', $renew->subscription_name, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_PRICE]', $renew->subscription_price . ' AOA', $headerText);
			$headerText = str_replace('[SUBSCRIPTION_MONTH]', $renew->subscription_month, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_DATE]', dateFormat($renew->start_date), $headerText);
			$headerText = str_replace('[SUBSCRIPTION_EXPIRY]', dateFormat($renew->expiry_date), $headerText);
			
			$data['body'] = $headerText;
			$data['to_email'] = $renew->email;
			
			Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
				$fromEmail = Common::getSettingdata(2);
				$message->from($fromEmail, 'Eventus Angola');
				$message->to($data['to_email'])->subject($data['email_subject']);
			});
			// Email section end //
			}
		}
		//// Renew mail to user, with in 30 days before expiry date end	////	
		
		
		
		//// Renew mail to user, on expiry date start ////
		
		$renewToday = DB::select(
					 DB::raw('SELECT hsr.*, u.first_name, u.email, ht.hall_name
					 		FROM ev_hall_subscription_relation as hsr
					 		inner join ev_hall as h ON hsr.hall_id = h.id
					 		inner join ev_hall_translation as ht ON ht.hall_id = h.id
					 		inner join ev_users as u on h.user_id = u.id
					 		where hsr.expiry_date = CURDATE()
					 		and hsr.payment_status = "1"
					 		and h.is_active = "1"
					 		and u.is_active = "1"
					 		and ht.language_id = 1
							'));	
		
		foreach($renewToday as $renew)
		{			
			// Email section start //
			$username = $renew->first_name;
			$emailTemplate = Common::getEmaildata(12, $data['language_val']);
			$data['email_subject'] = $emailTemplate->email_subject;
			$headerText = $emailTemplate->email_body;
			$headerText = str_replace('[USERNAME]', $username, $headerText);			
			$headerText = str_replace('[HALL_NAME]', $renew->hall_name, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_NAME]', $renew->subscription_name, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_PRICE]', $renew->subscription_price . ' AOA', $headerText);
			$headerText = str_replace('[SUBSCRIPTION_MONTH]', $renew->subscription_month, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_DATE]', dateFormat($renew->start_date), $headerText);
			$headerText = str_replace('[SUBSCRIPTION_EXPIRY]', dateFormat($renew->expiry_date), $headerText);
			
			$data['body'] = $headerText;
			$data['to_email'] = $renew->email;
			
			Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
				$fromEmail = Common::getSettingdata(2);
				$message->from($fromEmail, 'Eventus Angola');
				$message->to($data['to_email'])->subject($data['email_subject']);
			});
			// Email section end //
		}
		
		//// Renew mail to user, on expiry date end ////
		
		
		
		//// Renew mail to user, after expiry date start ////
		
		$renewAfter = DB::select(
					 DB::raw('SELECT hsr.*, DATEDIFF(CURDATE(),hsr.expiry_date) as duration, u.first_name, u.email, ht.hall_name
					 		FROM ev_hall_subscription_relation as hsr
					 		inner join ev_hall as h ON hsr.hall_id = h.id
					 		inner join ev_hall_translation as ht ON ht.hall_id = h.id
					 		inner join ev_users as u on h.user_id = u.id
					 		where DATEDIFF(CURDATE(),hsr.expiry_date) >= 1 and DATEDIFF(CURDATE(),hsr.expiry_date) <= '.$afterExpiry.'
					 		and hsr.payment_status = "1"
					 		and h.is_active = "1"
					 		and u.is_active = "1"
					 		and ht.language_id = 1
							'));	
		
		foreach($renewAfter as $renew)
		{
			
			$duration = $renew->duration;
			if($duration == 7 || $duration == 14 || $duration == 21 || $duration == 28 || $duration == 35 || $duration == 42){
			// Email section start //
			$username = $renew->first_name;
			$emailTemplate = Common::getEmaildata(13, $data['language_val']);
			$data['email_subject'] = $emailTemplate->email_subject;
			$headerText = $emailTemplate->email_body;
			$headerText = str_replace('[USERNAME]', $username, $headerText);			
			$headerText = str_replace('[HALL_NAME]', $renew->hall_name, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_NAME]', $renew->subscription_name, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_PRICE]', $renew->subscription_price . ' AOA', $headerText);
			$headerText = str_replace('[SUBSCRIPTION_MONTH]', $renew->subscription_month, $headerText);
			$headerText = str_replace('[SUBSCRIPTION_DATE]', dateFormat($renew->start_date), $headerText);
			$headerText = str_replace('[SUBSCRIPTION_EXPIRY]', dateFormat($renew->expiry_date), $headerText);
			
			$data['body'] = $headerText;
			$data['to_email'] = $renew->email;
			
			Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
				$fromEmail = Common::getSettingdata(2);
				$message->from($fromEmail, 'Eventus Angola');
				$message->to($data['to_email'])->subject($data['email_subject']);
			});
			// Email section end //
		 }
		}
		
		//// Renew mail to user, after expiry date end ////
		
	}

}
