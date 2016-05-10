<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Models\Common;
use Mail;

class AjaxController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//$this->middleware('auth');
		Input::get('contact_name');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Response
	 */
	/*public function index() {
		return view('home.index');
	}*/
	public function getLocation(Request $request) {
		$language_id 	= $request->session()->get('language_id');
		$hall = DB::table('location as loc')
			->select('ltrans.location_id', 'ltrans.location_name')
			->join('location_translation as ltrans', 'loc.location_id', '=', 'ltrans.location_id')
		//->where('ltrans.language_id', env('default_language'))->get();
			->where('ltrans.language_id', '=', $language_id)
			->orderBy('ltrans.location_name','asc')
			->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($hall);
		}
	}

	public function getProvince(Request $request) {
		$province = DB::table('province')
			->select('*')
			->orderBy('province_name','asc')
			->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($province);
		}
	}

	public function getLocationAuto(Request $request) {
		$language_id 	= $request->session()->get('language_id');
		$param = Input::get('term');
		$location = DB::table('location as loc');
		$location->select('ltrans.location_id', 'ltrans.location_name');
		$location->join('location_translation as ltrans', 'loc.location_id', '=', 'ltrans.location_id');
		//->where('ltrans.language_id', env('default_language'))->get();
		$location->where('ltrans.language_id', '=', $language_id);
		$return = $location->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($return);
		}
	}
	public function getProvinceAuto(Request $request) {
		$param = Input::get('term');
		$province = DB::table('province');
		$province->select('province_name');
		$province->where('province_name', 'like', '%' . $param . '%');
		$return = $province->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($return);
		}
	}
	public function setLanguage(Request $request) {
		$selected_lang_id = Input::get('langid');
		$request->session()->put('language_id', $selected_lang_id);
		echo 1;
	}
	
	public function setCurrency(Request $request) {
		$selected_currency_id = Input::get('currency_id');
		$request->session()->put('currency_id', $selected_currency_id);
		echo 1;
	}
	
	public function getHalltype(Request $request)
	{
		$language_id = $request->session()->get('language_id');
		$halltype = DB::table('hall_type as htype')
	            ->select('*')
	            ->join('hall_type_translation as htrans', 'htype.id', '=', 'htrans.hall_type_id')
	            ->where('htrans.language_id',$language_id)
	            ->orderBy('htrans.hall_type_name')
	            ->get();
	    if ($request->wantsJson() || $request->isJson()) {
			return response()->json($halltype);
		}
	}
	
	public function getPricerange(Request $request)
	{
		$language_id = $request->session()->get('language_id');
		$priceRange = DB::table('price_range as pr')
		            ->select('*')
		            ->join('price_range_translation as ptrans', 'pr.id', '=', 'ptrans.price_range_id')
		            ->where('pr.currency_id',1)
		            ->where('ptrans.language_id',$language_id) 
		            ->orderBy('pr.id')        
		            ->get();
	    if ($request->wantsJson() || $request->isJson()) {
			return response()->json($priceRange);
		}
	}
	
	public function setFavorite(Request $request)
	{
		$hall_id = Input::get('hall_id');
		
		$favCount = DB::table('favorite')
					->where('user_id', Auth::user()->id)
					->where('hall_id', $hall_id)
					->count();
		
		if($favCount == 0)
		{
			$id = DB::table('favorite')->insertGetId(
    		['user_id' => Auth::user()->id , 'hall_id' => $hall_id, 'created_at' => date('Y-m-d H:i:s')]
			);
			echo $id;
		}
		else
		 echo 0;
	}
	
	public function setReview(Request $request)
	{
		$language_id 	= $request->session()->get('language_id');
		$hall_id = Input::get('hall_id');
		$review_text = Input::get('review_text');
		$review_rating = Input::get('review_rating');
		$id = DB::table('review')->insertGetId(
			['user_id' => Auth::user()->id,
    		 'hall_id' => $hall_id,
    		 'review_text' => $review_text,
    		 'review_rating' => $review_rating,    		 
    		 'created_at' => date('Y-m-d H:i:s')]
		);
		
		// Email section start //
		$hallDetails = Common::hallDetails($language_id,$hall_id);
		$userDetails = Common::getUser($hallDetails->user_id);
        $postedby = Auth::user()->first_name.' '.Auth::user()->last_name;     
		$emailTemplate = Common::getEmaildata(6,$language_id);	
		$data['email_subject'] = $emailTemplate->email_subject;
		$headerText = $emailTemplate->email_body;
		$headerText = str_replace('[USERNAME]',$userDetails->first_name,$headerText);
		$headerText = str_replace('[HALL_NAME]',$hallDetails->hall_name,$headerText);
		$headerText = str_replace('[POSTEDBY]',$postedby,$headerText);
		$headerText = str_replace('[REVIEWTEXT]',$review_text,$headerText);		
		
		$data['body'] = $headerText;
		$data['toemail'] = $userDetails->email;
				
		//return view('emails.email_template', ['data' => $data]);
		Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
			$fromEmail = Common::getSettingdata(2);			
			$message->from($fromEmail, 'Eventus Angola');
			$message->to($data['toemail'])->subject($data['email_subject']);
		});
        // Email section end //  
        
		echo $id;
		
	}
	
	public function setEnquiry(Request $request)
	{
		$language_id 	= $request->session()->get('language_id');
		$id = DB::table('messages')
			->insertGetId(
			    ['msg_parent_id' => 0, 'hall_id' => $request->hall_id, 'message' => $request->message, 'from_user_id' => Auth::user()->id, 'to_user_id' => $request->to_user_id, 'msg_datetime' => date('Y-m-d H:i:s'), 'msgpost_datetime' => date('Y-m-d H:i:s'),'msg_is_replied'=>'N']
			   );
			   
		// Email section start //
		$userDetails = Common::getUser($request->to_user_id);
        $postedby = Auth::user()->first_name.' '.Auth::user()->last_name;     
		$emailTemplate = Common::getEmaildata(3,$language_id);	
		$data['email_subject'] = $emailTemplate->email_subject;
		$headerText = $emailTemplate->email_body;
		$headerText = str_replace('[USERNAME]',$userDetails->first_name,$headerText);
		$headerText = str_replace('[POSTEDBY]',$postedby,$headerText);
		$headerText = str_replace('[ENQUIRYTEXT]',$request->message,$headerText);		
		
		$data['body'] = $headerText;
		$data['toemail'] = $userDetails->email;
				
		//return view('emails.email_template', ['data' => $data]);
		Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
			$fromEmail = Common::getSettingdata(2);			
			$message->from($fromEmail, 'Eventus Angola');
			$message->to($data['toemail'])->subject($data['email_subject']);
		});
        // Email section end //  
			
		echo $id;
	}
	
	public function currentLocation(Request $request)
	{
		$language_id = $request->session()->get('language_id');
		$lat = Input::get('lat');
		$lng = Input::get('lng');
		$query = 'SELECT loc.location_id,location_name, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( loc.location_lat ) ) * cos( radians( loc.location_lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( loc.location_lat ) ) ) ) AS distance 
					FROM ev_location as loc
					left join ev_location_translation as lt on loc.location_id = lt.location_id
					where lt.language_id='.$language_id.'
					having distance <= 5';
		$location = DB::select(DB::raw($query));
		//dd($location);
		return $location[0]->location_id;
	}
	
	public function getAvailability(Request $request)
	{
		$checkin_date = dateFormatDB(Input::get('checkin_date'));
		$checkout_date = dateFormatDB(Input::get('checkout_date'));
		$hall_id = Input::get('hall_id');
		$availability = Common::checkAvailability($hall_id,$checkin_date,$checkout_date);
		return count($availability);
	}
	
	public function setNewsletter(Request $request)
	{
		$this->validate($request, [
			'newsletter_email' => 'required|email|max:255|unique:newsletter',
		]);
		$language_id 	= $request->session()->get('language_id');
		$newsletter_email = Input::get('newsletter_email');
		if(!empty($newsletter_email))
		{
			$newsletter_id = DB::table('newsletter')->insertGetId(
			    		['newsletter_email' =>$newsletter_email , 'created_at' => date('Y-m-d H:i:s')]
					);
		if($newsletter_id)
		{
			// Email section start //
			$data= array();	        
			$emailTemplate = Common::getEmaildata(10,$language_id);
			$data['email_subject'] = $emailTemplate->email_subject;
			$headerText = $emailTemplate->email_body;
			$headerText = str_replace('[NEWSLETTER_EMAIL]',$newsletter_email,$headerText);
			
			$data['body'] = $headerText;
			
			Mail::send('emails.email_template', ['data' => $data], function ($message) use ($data) {
				$fromEmail = Common::getSettingdata(2);	
				$toEmail = Common::getSettingdata(14);		
				$message->from($fromEmail, 'Eventus Angola');
				$message->to($toEmail)->subject($data['email_subject']);
			});
	        // Email section end //  
		}
		return 1;
		}
		else
		return 0;
	}
	
	public function advClick(){
		$advertisement_id = Input::get('advertisement_id');
		$user_ip = $_SERVER['REMOTE_ADDR'];
		if($advertisement_id != ''){
			
			$getData = DB::table('advertisement_impression_click')
					->where('advertisement_id',$advertisement_id)
					->where('user_ip',$user_ip)
					->where('date',date('Y-m-d'))
					->count();
			
			if($getData == 0){				
				$insertId = DB::table('advertisement_impression_click')
					->insert(
					['advertisement_id' => $advertisement_id,
					 'user_ip' => $user_ip,
					 'date' => date('Y-m-d')
					]);
				echo 1;
			}
			else
			echo 0;
		}
		else
		echo 0;		
	}

}
