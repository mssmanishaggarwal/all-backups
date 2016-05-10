<?php

namespace App\Http\Controllers;
use App\Helper\Languagehelper;
use App\Helper\Advertisementhelper;
use App\Models\Common;
use Response;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller {
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
		$data['cms_id'] = 1;
		return $data;
	}

	public function index(Request $request) {
		
		$request->session()->forget('breadcrumb');
		$request->session()->forget('hallOrderBy');
		$request->session()->forget('limitTo');
		$data = $this->languageSetter($request);		
		$hallType = Common::getHalltype($data['language_val']);
		$priceRange = Common::getPricerange($data['language_val']);
		$locationList = Common::getLocation($data['language_val']);
		$bannerList = Common::getBanner($data['language_val']);
		$featuredHall = Common::getFeaturedHall($data['language_val']);
		
		foreach ($featuredHall as $key => $val) {
			$featuredHall[$key]->hall_type_name = Common::getHalltypeName($data['language_val'], explode(',', $val->hall_type));
			$featuredHall[$key]->hall_url	= url('/hall').'/'.base64_encode($val->hall_id);
		}

		$data['cmsArr'] = Common::cmsdata($data['language_val'], 1);
		$data['testimonialList'] = Common::testimonialList($data['language_val']);

		$data['hallType'] = $hallType;
		$data['priceRange'] = $priceRange;
		$data['locationList'] = $locationList;
		$data['bannerList'] = $bannerList;
		$data['featuredHall'] = $featuredHall;
		/*$variables = Sitevariablehelper::set_Variables(1,'eventus_1');
			    	$request->session()->put('language_id', '1');
			    	$data = $request->session()->all();
			    	print_r($variables);
			    	echo $request->session()->get('language_id');
			    	exit;
			    	dd($featuredHall);
		*/
		//Cookie::queue('location', 'andulo', 60);
		//$response = new Illuminate\Http\Response('Hello World');
		//$response = $next($request);
		
		//setcookie('location', 'aaaaa', time() + (86400 * 1), "/");
		
	    //$value = $request->cookie();
		//dd($value);
		$breadcrumbArray['Home'] = url('/');
		$request->session()->put('breadcrumb', $breadcrumbArray);
		return view('home.index', ['data' => $data]);
	}

	public function search(Request $request) {
			
		$data = $this->languageSetter($request);
		$perPage = Common::getSettingdata(3);
			
		$hallType = Common::getHalltype($data['language_val']);
		$priceRange = Common::getPricerange($data['language_val']);
		$locationList = Common::getLocation($data['language_val']);

		$search_location = Input::get('search_location');
		$search_checkin = Input::get('search_checkin');
		$search_checkout = Input::get('search_checkout');
		$search_halltype = Input::get('search_halltype');
		$search_pricerange = Input::get('search_pricerange');
		$order_by = Input::get('order_by');
		$data['order_by'] = '';
		if($order_by != '')
		{
			$request->session()->put('hallOrderBy', $order_by);			
		}		
		if($request->session()->get('hallOrderBy'))
		{
			$order_by = $request->session()->get('hallOrderBy');
			$data['order_by'] = $order_by;
		}
		
			
		$from = isset($request->from)?$request->from:0;		
		$lat = '';
		$lng = '';
		if (!empty($search_location) && $search_location != 0) 
		{
			$locationDetails = Common::getLocationDetails($search_location,$data['language_val']);
			
			$lat = 	$locationDetails->location_lat;		
			$lng = 	$locationDetails->location_lng;
			
					
		}
				
		$query = 'select ha.*, htrans.*, hr.hall_type,image.hall_image,lc.location_name,pr.province_name,rv.ratePercentage, rv.totalReview';
		if (!empty($search_location) && $lat != '' && $lng != '') 
		{
			$query .= ', ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( ha.lat ) ) * cos( radians( ha.lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians( ha.lat ) ) ) ) AS distance';	
		}	
		$query .= ' from ev_hall as ha
			left join ev_hall_translation as htrans on ha.id = htrans.hall_id
			left join ev_hallimages as image on ha.id = image.hall_id
			left join ev_location_translation as lc on lc.location_id = ha.location_id
			left join ev_province as pr on pr.id = ha.hall_province
			left join (select htr.hall_id,htr.hall_type_id,group_concat(htr.hall_type_id separator ",") as hall_type from ev_hall_type_relation as htr group by htr.hall_id) hr on hr.hall_id = ha.id
			left join (select rev.hall_id, count(rev.review_rating) as totalReview ,(sum(rev.review_rating) / count(rev.review_rating)) as ratePercentage from ev_review as rev group by rev.hall_id) rv on rv.hall_id = ha.id
			where htrans.language_id = '.$data["language_val"].' 
			and lc.language_id = '.$data["language_val"].' 
			and image.image_order = 1';
			
		if (!empty($search_location) && $lat != '' && $lng != '')
		$query .= ' having distance <= 20';

		/*if (!empty($search_location)) {
			$query .= ' and ha.location_id =' . $search_location;
			
		}*/		
		
		if (!empty($search_halltype)) {
			//$query .= ' and hr.hall_type_id =' . $search_halltype;			
			//$query .= ' and '.$search_halltype.' IN (hr.hall_type)';
			$query .= ' and FIND_IN_SET("'.$search_halltype.'",hr.hall_type)';
		}

		if (!empty($search_pricerange)) {
			$price_range = DB::table('price_range as p')
				->select('p.lower_range', 'p.upper_range')
				->where('p.id', $search_pricerange)
				->first();
			
			if($request->session()->get('currency_id') == 2)
			$query .= ' and ha.rental_amount_euro between ' . $price_range->lower_range . ' and ' . $price_range->upper_range;
			else
			$query .= ' and ha.rental_amount between ' . $price_range->lower_range . ' and ' . $price_range->upper_range;
		}
		
		if(!empty($order_by))
		{
			if($order_by == 'phtl')
			$query .= ' order by ha.rental_amount desc';
			if($order_by == 'plth')
			$query .= ' order by ha.rental_amount asc';
			if($order_by == 'sbr')
			$query .= ' order by rv.ratePercentage desc';
		}
		else
		$query .= ' order by rv.ratePercentage desc';	
		
		$totalRecord = DB::select(DB::raw($query));
		
		if(!empty($order_by) && $request->page == '' && $request->session()->get('limitTo') != '')
		$query .= ' limit 0,'.$request->session()->get('limitTo');
		else
		$query .= ' limit '.$from.','.$perPage;
		
		$result = DB::select(DB::raw($query));	
		
		if($search_checkin != '' && $search_checkout != '')
		{
			$result_availability = array();
			foreach ($result as $key => $val) 
			{
				$availabilty = Common::checkAvailability($val->hall_id,dateFormatDB($search_checkin),dateFormatDB($search_checkout));
				echo count($availabilty);
				if(count($availabilty) == 0)
				$result_availability[] = $val;
				$availabilty = '';
			}
			
			$result = 	$result_availability;			
		}
		else
		{
			$result = $result;
		}
		
		

		foreach ($result as $key => $val) {
			$result[$key]->hall_type_name = Common::getHalltypeName($data['language_val'], explode(',', $val->hall_type), 1);
			$result[$key]->hall_url	= url('/hall').'/'.base64_encode($val->hall_id);			
			
		}	
		
		$currentPage = $request->page;	
		$resultPage = new Paginator($totalRecord, $perPage, $currentPage);
		$next_page = 0;
		$data['next_page_url'] = '';
		$pageData = $resultPage->toArray();
		if($resultPage->hasPages() && count($totalRecord) >= $pageData['to'])
		{
			$next_page = $resultPage->currentPage() + 1;
							
			$data['next_page_url'] = url('/search?search_location='.$search_location.'&search_checkin='.$search_checkin.'&search_checkout='.$search_checkout.'&search_halltype='.$search_halltype.'&search_pricerange='.$search_pricerange.'&page='.$next_page.'&from='.$pageData['to']);
					
		}
		$data['hallList'] = $result;
		$data['hallType'] = $hallType;
		$data['priceRange'] = $priceRange;
		$data['locationList'] = $locationList;
		$data['search_location'] = $search_location;
		$data['search_checkin'] = $search_checkin;
		$data['search_checkout'] = $search_checkout;
		$data['search_halltype'] = $search_halltype;
		$data['search_pricerange'] = $search_pricerange;
		$data['from'] = isset($pageData['from'])?$pageData['from']:$from;	
		
		
		// Advertisement section starts //
		$advertisement = new Advertisementhelper();
		$data['advDetails'] = $advertisement->advertisement($data['language_val']);
		//dd($data['advDetails']);
		// Advertisement section ends  //	
		
		$request->session()->forget('breadcrumb');	
		$breadcrumbArray = $request->session()->get('breadcrumb');
		$breadcrumbArray['Home'] = url('/');
		//$breadcrumbArray['Search'] = url('/search?'.$_SERVER['QUERY_STRING']);
		$breadcrumbArray['Search'] = url('/search?search_location='.$search_location.'&search_checkin='.$search_checkin.'&search_checkout='.$search_checkout.'&search_halltype='.$search_halltype.'&search_pricerange='.$search_pricerange);
		$request->session()->put('breadcrumb', $breadcrumbArray);
		$data['breadcrumb'] = $request->session()->get('breadcrumb');
		if($request->page != '')
		$request->session()->put('limitTo', $pageData['to']);
		if($request->ajax())
		{			
			return [
			'posts' => view('home.ajax_listing',['data' => $data])->render(),
			'next_page_url' => $data['next_page_url']
			];	
		}		
		else
		return view('home.listing', ['data' => $data]);
	}
	

}
