<?php

namespace App\Models;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Common extends Model {
	public static function getHalltype($language_id) {

		$halltype = DB::table('hall_type as htype')
			->select('*')
			->join('hall_type_translation as htrans', 'htype.id', '=', 'htrans.hall_type_id')
			->where('htrans.language_id', $language_id)
			->where('htype.is_active', '=', '1')
			->orderBy('htrans.hall_type_name')
			->get();
		return $halltype;
	}
	
	public static function getfacilitiesList($language_id) {

		$faclist = DB::table('facilities as fac')
			->select('*')
			->join('facilities_translation as factra', 'fac.id', '=', 'factra.facilities_id')
			->where('factra.language_id', $language_id)
			->where('fac.is_active', '=', '1')
			->orderBy('factra.facilities_name')
			->get();
		return $faclist;
	}

	public static function getPricerange($language_id) {
		$request = request();
		$currency_id = $request->session()->get('currency_id');
		$priceRange = DB::table('price_range as pr')
			->select('*')
			->join('price_range_translation as ptrans', 'pr.id', '=', 'ptrans.price_range_id')
			->where('pr.currency_id', $currency_id)
			->where('ptrans.language_id', $language_id)
			->where('pr.is_active', '=', '1')
			->orderBy('pr.id')
			->get();
		return $priceRange;
	}

	public static function getLocation($language_id) {
		$location = DB::table('location as loc')
			->select('ltrans.location_id', 'ltrans.location_name')
			->join('location_translation as ltrans', 'loc.location_id', '=', 'ltrans.location_id')
			->where('ltrans.language_id', '=', $language_id)
			->orderBy('ltrans.location_name', 'asc')
			->get();
		return $location;
	}

	public static function getLocationDetails($location_id, $language_id) {
		$location = DB::table('location as loc')
			->select('loc.*', 'ltrans.location_id', 'ltrans.location_name')
			->join('location_translation as ltrans', 'loc.location_id', '=', 'ltrans.location_id')
			->where('ltrans.language_id', '=', $language_id)
			->where('loc.location_id', '=', $location_id)
			->first();
		return $location;
	}

	public static function selectaddon($language_id) {
		$hall = DB::table('addon as loc')
			->select('*')
			->join('addon_translation as ltrans', 'loc.id', '=', 'ltrans.addon_id')
			->where('loc.is_active', '=', 1)
			->where('ltrans.language_id', '=', $language_id)->get();
		//->where('ltrans.language_id', env('default_language'))->get();
		return $hall;
	}
	public static function selectaccommodation($language_id) {
		$hall = DB::table('accommodation as loc')
			->select('*')
			->join('accommodation_translation as ltrans', 'loc.id', '=', 'ltrans.accommodation_id')
			->where('loc.is_active', '=', 1)
			->where('ltrans.language_id', '=', $language_id)->get();
			//->where('ltrans.language_id', env('default_language'))->get();
		return $hall;
	}

	public static function getProvince() {
		$province = DB::table('province')
			->select('*')
			->orderBy('province_name', 'asc')
			->get();
		return $province;
	}

	public static function getBanner($language_id) {
		$banner = DB::table('banner as ban')
			->select('ban.*', 'btrans.banner_title')
			->join('banner_translation as btrans', 'ban.id', '=', 'btrans.banner_id')
			->where('btrans.language_id', '=', $language_id)
			->where('ban.is_active', 1)
			->orderBy('ban.order_id', 'asc')
			->get();
		return $banner;
	}
	public static function myFavourite($language_id) {
		$favorite = DB::table('favorite as fav')
			->select('hltr.hall_name', 'hl.rental_amount', 'hlimg.hall_image', 'loc.location_name', 'prov.province_name', 'hl.id')
			->leftJoin('hall as hl', 'hl.id', '=', 'fav.hall_id')
			->leftJoin('hall_translation as hltr', 'hltr.hall_id', '=', 'fav.hall_id')
			->leftJoin('hallimages as hlimg', 'hlimg.hall_id', '=', 'fav.hall_id')
			->leftJoin('location_translation as loc', 'loc.location_id', '=', 'hl.location_id')
			->leftJoin('province as prov', 'prov.id', '=', 'hl.hall_province')
			->where('loc.language_id', '=', $language_id)
			->where('hltr.language_id', '=', $language_id)
			->where('hlimg.image_order', '=', 1)
			->where('fav.user_id', '=', Auth::user()->id)
			->orderBy('fav.created_at', 'desc')
			->get();
		return $favorite;
	}
	public static function myReviews($language_id) {
		$review = DB::table('review as rivw')
			->select('rivw.review_rating', 'rivw.created_at', 'rivw.review_text', 'hltr.hall_name', 'hltr.official_name', 'loc.location_name', 'prov.province_name', 'hl.id')
			->leftJoin('hall as hl', 'hl.id', '=', 'rivw.hall_id')
			->leftJoin('hall_translation as hltr', 'hltr.hall_id', '=', 'rivw.hall_id')
			->leftJoin('location_translation as loc', 'loc.location_id', '=', 'hl.location_id')
			->leftJoin('province as prov', 'prov.id', '=', 'hl.hall_province')
			->where('loc.language_id', '=', $language_id)
			->where('hltr.language_id', '=', $language_id)
			->where('rivw.is_active', '=', 1)
			->where('rivw.user_id', '=', Auth::user()->id)
			->orderBy('rivw.created_at', 'desc')
			->get();
		return $review;
	}
	public static function reviewsOnMyHall($language_id) {
		$review = DB::table('review as rivw')
			->select('rivw.review_rating', 'rivw.created_at', 'rivw.review_text', 'hltr.hall_name', 'hltr.official_name', 'loc.location_name', 'prov.province_name', 'hl.id','usr.first_name','usr.last_name','usr.profile_image')
			->leftJoin('hall as hl', 'hl.id', '=', 'rivw.hall_id')
			->leftJoin('hall_translation as hltr', 'hltr.hall_id', '=', 'rivw.hall_id')
			->leftJoin('location_translation as loc', 'loc.location_id', '=', 'hl.location_id')
			->leftJoin('province as prov', 'prov.id', '=', 'hl.hall_province')
			->leftJoin('users as usr', 'usr.id', '=', 'rivw.user_id')
			->where('loc.language_id', '=', $language_id)
			->where('hltr.language_id', '=', $language_id)
			->where('rivw.is_active', '=', 1)
			->where('hl.user_id', '=', Auth::user()->id)
		//->where('rivw.user_id', '=', Auth::user()->id)
			->orderBy('rivw.created_at', 'desc')
			->get();
		return $review;

	}
	public static function hallTypeForMyHall($hall_id, $language_id) {
		$halltype = DB::table('hall_type_relation as htr')
			->select('htrans.hall_type_name')
			->join('hall_type_translation as htrans', 'htr.hall_type_id', '=', 'htrans.hall_type_id')
			->where('htr.hall_id', $hall_id)
			->where('htrans.language_id', $language_id)
			->orderBy('htrans.hall_type_name')
			->get();
		return $halltype;
	}
	public static function hallTypeForMyAddon($hall_id, $language_id) {
		$addon = DB::table('hall_addon_relation as addr')
			->select('addtrs.addon_name', 'addr.addon_price')
			->join('addon_translation as addtrs', 'addr.addon_id', '=', 'addtrs.addon_id')
			->where('addr.hall_id', $hall_id)
			->where('addtrs.language_id', $language_id)
			->orderBy('addtrs.addon_name')
			->get();
		return $addon;
	}
	public static function hallTypeForMyAccommodation($hall_id, $language_id) {
		$accommodation = DB::table('hall_accommodation_relation as har')
			->select('acctrs.accommodation_name', 'har.accommodation_number')
			->join('accommodation_translation as acctrs', 'har.accommodation_id', '=', 'acctrs.accommodation_id')
			->where('har.hall_id', $hall_id)
			->where('acctrs.language_id', $language_id)
			->orderBy('acctrs.accommodation_name')
			->get();
		return $accommodation;
	}
	public static function getFeaturedHall($language_id) {		

		$query = DB::select(DB::raw('select ev_ha.*, ev_htrans.*, hr.hall_type, ev_image.hall_image
				from ev_hall as ev_ha
				left join ev_hall_translation as ev_htrans on ev_ha.id = ev_htrans.hall_id
				left join ev_hallimages as ev_image on ev_ha.id = ev_image.hall_id
				left join (select ev_htr.hall_id, group_concat( ev_htr.hall_type_id separator ",") as hall_type from ev_hall_type_relation as ev_htr group by ev_htr.hall_id) hr on hr.hall_id = ev_ha.id				
				where ev_htrans.language_id = 1 
				and ev_ha.is_active = "1"
				and ev_image.image_order = 1				
				order by RAND() desc 
				limit 6'));
				
//left join ev_hall_subscription_feature_relation as ev_hsfr on ev_hsfr.hall_id = ev_ha.id
//and CURDATE() between ev_hsfr.start_date and ev_hsfr.expiry_date and ev_hsfr.payment_status = "1" 
		return $query;
	}

	public static function getHalltypeName($language_id, $hall_type, $return_type = '') {
		$query = DB::table('hall_type_translation as htt');
		$query->select('htt.hall_type_name');
		$query->whereIn('htt.hall_type_id', $hall_type);
		$query->where('htt.language_id', $language_id);
		$query->orderBy('htt.hall_type_name');
		$result = $query->get();

		foreach ($result as $key => $res) {
			$result[$key] = (array) $res;
		}
		$result = array_map('current', $result);
		if ($return_type == 1) {
			return $result;
		} else {
			return implode(', ', $result);
		}

	}

	public static function cmsdata($language_id, $cmsid) {
		$query = DB::table('cms as c');
		$query->select('c.*', 'cd.*');
		$query->join('cms_data as cd', 'cd.cms_id', '=', 'c.id');
		$query->where('cd.language_id', $language_id);
		$query->where('c.id', $cmsid);
		$result = $query->first();
		return $result;
	}

	public static function testimonialList($language_id) {
		$query = DB::table('testimonial as t');
		$query->select('t.*', 'td.*');
		$query->join('testimonial_translation as td', 'td.testimonial_id', '=', 't.id');
		$query->where('td.language_id', $language_id);
		$query->where('t.is_active', 1);
		$query->orderBy('t.order_id', 'asc');
		$result = $query->get();
		return $result;
	}

	public static function hallDetails($language_id, $id) {
		$query = DB::table('hall as h');
		$query->select('h.*', 'ht.*', 'pr.province_name', 'lc.location_name');
		$query->join('hall_translation as ht', 'h.id', '=', 'ht.hall_id');
		$query->leftJoin('province as pr', 'pr.id', '=', 'h.hall_province');
		$query->leftJoin('location_translation as lc', 'lc.location_id', '=', 'h.location_id');
		$query->where('ht.language_id', $language_id);
		$query->where('lc.language_id', $language_id);
		$query->where('h.id', $id);
		$result = $query->first();
		return $result;
	}

	public static function fetchMessages() {
		return 'I am here';
	}

	public static function hallImage($id) {
		$result = DB::table('hallimages as hi')
			->where('hi.hall_id', $id)
			->orderBy('hi.image_order', 'asc')
			->pluck('hi.hall_image');

		return $result;
	}
	public static function getUserEmail($user_id) {
		$result = DB::table('users')
			->where('id', $user_id)
			->pluck('email');

		return $result;
	}
	public static function getToUserName($user_id) {
		$result = DB::table('users')
			->where('id', $user_id)
			->pluck('first_name');

		return $result;
	}
	public static function hallName($id) {
		$result = DB::table('hall_translation')
			->select('hall_name')
			->where('hall_translation.hall_id', $id)
			->where('hall_translation.language_id', 1)
			->pluck('hall_name');

		return $result;
	}

	public static function hallAddon($language_id, $id) {
		$result = DB::table('hall_addon_relation as har')
			->select('har.addon_id', 'har.addon_price', 'at.addon_name')
			->leftJoin('addon_translation as at', 'har.addon_id', '=', 'at.addon_id')
			->where('har.hall_id', $id)
			->where('at.language_id', $language_id)
			->orderBy('at.addon_name', 'asc')
			->get();
		return $result;
	}

	public static function hallReview($id) {
		$result = DB::table('review as r')
			->select('r.*', 'u.first_name', 'u.last_name', 'u.profile_image')
			->join('users as u', 'u.id', '=', 'r.user_id')
			->where('r.hall_id', $id)
			->where('r.is_active', '=', 1)
			->orderBy('r.created_at', 'desc')
			->get();
		return $result;
	}

	public static function hallAccommodation($language_id, $id) {
		$result = DB::table('hall_accommodation_relation as har')
			->select('har.accommodation_number', 'at.accommodation_name')
			->leftJoin('accommodation_translation as at', 'har.accommodation_id', '=', 'at.accommodation_id')
			->where('har.hall_id', $id)
			->where('at.language_id', $language_id)
			->orderBy('at.accommodation_name', 'asc')
			->get();
		return $result;
	}
	
	public static function hallTypeDetails($language_id, $id) {
		$result = DB::table('hall_type_relation as htr')
			->select('htrans.hall_type_name')
			->join('hall_type_translation as htrans', 'htr.hall_type_id', '=', 'htrans.hall_type_id')
			->where('htr.hall_id', $id)
			->where('htrans.language_id', $language_id)
			->orderBy('htrans.hall_type_name')
			->get();
		return $result;
	}

	public static function fetchSubscription($language_id) {
		$hall = DB::table('subscription as loc')
			->select('*')
			->join('subscription_translation as ltrans', 'loc.id', '=', 'ltrans.subscription_id')
			->where('loc.is_active', '=', 1)
			->where('ltrans.language_id', '=', $language_id)->get();
		return $hall;
	}
	public static function fetchSubscriptionFeatured($language_id) {
		$hall = DB::table('subscription_feature')
			->select('*')
		//->join('subscription_translation as ltrans', 'loc.id', '=', 'ltrans.subscription_id')
			->where('subscription_feature.is_active', '=', 1)->get();
		//->where('ltrans.language_id', '=', $language_id)->get();
		return $hall;
	}
	public static function fetchsubScriptionStatus($language_id, $hall_id) {
		$data = DB::table('hall_subscription_relation')
			->select('payment_date', 'subscription_month', 'subscription_name', 'start_date', 'expiry_date')
			->where('hall_id', '=', $hall_id)
			->where('payment_status', '=', 1)
			->get('payment_date');
		return $data;
	}
	public static function fetchsubFeaturedStatus($language_id, $hall_id) {
		$data = DB::table('hall_subscription_feature_relation')
			->select('payment_date', 'feature_month', 'feature_name', 'start_date', 'expiry_date')
			->where('hall_id', '=', $hall_id)
			->where('payment_status', '=', 1)
			->get('payment_date');
		return $data;
	}
	public static function fetchsubScriptionStatusByID($language_id, $id) {
		$data = DB::table('hall_subscription_relation')
			->select('payment_date', 'subscription_month', 'subscription_name')
			->where('id', '=', $id)
			->where('payment_status', '=', 1)
			->get('payment_date');
		return $data;
	}
	public static function checkSubExpiry($hall_id) {

		$returnable = DB::select(DB::raw("SELECT `expiry_date` FROM `ev_hall_subscription_relation` WHERE `payment_status`='1' AND
		`hall_id`='" . $hall_id . "' AND CURDATE() between start_date and expiry_date"));
		if ($returnable) {
			return $returnable[0]->expiry_date;
		} else {
			return 'notfound';
		}

	}
	public static function checkSubExpiryFeature($hall_id) {
		$returnable = DB::select(DB::raw("SELECT `expiry_date` FROM `ev_hall_subscription_feature_relation` WHERE `payment_status`='1' AND
		`hall_id`='" . $hall_id . "' AND CURDATE() between start_date and expiry_date"));
		if ($returnable) {
			return $returnable[0]->expiry_date;
		} else {
			return 'notfound';
		}
	}
	public static function fetchsubScriptionFeatureStatusByID($language_id, $id) {
		$data = DB::table('hall_subscription_feature_relation')
			->select('payment_date', 'feature_month', 'feature_name')
			->where('id', '=', $id)
			->where('payment_status', '=', 1)
			->get('payment_date');
		return $data;
	}

	public static function hallFacilities($language_id, $id) {
		$result = DB::table('hall_facilities_relation as hfr')
			->select('ft.facilities_name', 'f.icon_name')
			->leftJoin('facilities as f', 'f.id', '=', 'hfr.facilities_id')
			->leftJoin('facilities_translation as ft', 'f.id', '=', 'ft.facilities_id')
			->where('hfr.hall_id', $id)
			->where('ft.language_id', $language_id)
			->orderBy('ft.facilities_name', 'asc')
			->get();
		return $result;
	}

	public static function hallSimilar($language_id, $lat, $lng, $id) {
		$query = 'SELECT h.*,ht.*,image.hall_image,lc.location_name,pr.province_name,rv.ratePercentage, rv.totalReview,
				( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( h.lat ) ) * cos( radians( h.lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians( h.lat ) ) ) ) AS distance
					FROM ev_hall as h
					left join ev_hall_translation as ht on h.id = ht.hall_id
					left join ev_hallimages as image on h.id = image.hall_id
					left join ev_location_translation as lc on lc.location_id = h.location_id
					left join ev_province as pr on pr.id = h.hall_province
					left join (select rev.hall_id, count(rev.review_rating) as totalReview ,(sum(rev.review_rating) / count(rev.review_rating)) as ratePercentage from ev_review as rev where rev.is_active = 1 group by rev.hall_id) rv on rv.hall_id = h.id
					where ht.language_id=' . $language_id . '
					and lc.language_id = ' . $language_id . '
					and image.image_order = 1
					and h.id != ' . $id . '
					having distance <= 20
					order by rv.ratePercentage desc';
		$hallList = DB::select(DB::raw($query));
		return $hallList;
	}

	public static function allNews($language_id) {
		$todayDate = date('Y-m-d');
		$news = DB::table('news as n')
			->select('n.*', 'nt.news_title', 'nt.news_content')
			->join('news_translation as nt', 'n.id', '=', 'nt.news_id')
			->where('nt.language_id', '=', $language_id)
			->where('n.is_active', 1)
			->where('n.published_date', '<=', $todayDate)
			->orderBy('n.published_date', 'desc')
			->get();
		return $news;
	}

	public static function allFaq($language_id) {
		$faq = DB::table('faq as f')
			->select('f.*', 'ft.faq_title', 'ft.faq_content')
			->join('faq_translation as ft', 'f.id', '=', 'ft.faq_id')
			->where('ft.language_id', '=', $language_id)
			->where('f.is_active', 1)
			->orderBy('f.order_id', 'asc')
			->get();
		return $faq;
	}

	public static function checkAvailability($hall_id, $check_in, $check_out) {
		$checkin_day =  date('w', strtotime($check_in));
		$checkout_day =  date('w', strtotime($check_out));
		
		$checkin_mday = date('d', strtotime($check_in));
		$checkout_mday =  date('d', strtotime($check_out));
		
		/*$query = 'SELECT *
				FROM ev_booking as bk, ev_hall_block as hb
				WHERE (bk.check_in >= ' . $check_in . '
				and bk.check_out <=  ' . $check_out . '
				and bk.hall_id = ' . $hall_id . ')
				OR
				(hb.start_date >= ' . $check_in . '
				and hb.end_date <=  ' . $check_out . '
				and hb.hall_id = ' . $hall_id . ')';*/

		/*$query = 'SELECT *
				FROM ev_booking as bk
				WHERE bk.hall_id = ' . $hall_id . '
				and ((bk.check_in <= "' . $check_in . '" and bk.check_out >= "' . $check_in . '")
				OR (bk.check_in <= "' . $check_out . '" and bk.check_out >= "' . $check_out . '")
				OR (bk.check_in >= "' . $check_in . '" and bk.check_out <= "' . $check_out . '"))'
		;*/
		
		$query = 'SELECT bk.hall_id
				FROM ev_booking as bk				
				WHERE bk.hall_id = ' . $hall_id . '
				and ((bk.check_in <= "' . $check_in . '" and bk.check_out >= "' . $check_in . '")
				OR (bk.check_in <= "' . $check_out . '" and bk.check_out >= "' . $check_out . '")
				OR (bk.check_in >= "' . $check_in . '" and bk.check_out <= "' . $check_out . '"))
				UNION ALL
				SELECT hb.hall_id
				FROM ev_hall_block as hb
				WHERE hb.hall_id = ' . $hall_id . '
				and 
				CASE
				WHEN hb.block_type="D"
				THEN
				((hb.start_date <= "' . $check_in . '" and hb.end_date >= "' . $check_in . '")
				OR (hb.start_date <= "' . $check_out . '" and hb.end_date >= "' . $check_out . '")
				OR (hb.start_date >= "' . $check_in . '" and hb.end_date <= "' . $check_out . '"))
				WHEN hb.block_type="W"
				THEN
				hb.week_day BETWEEN "'.$checkin_day.'" and "'.$checkout_day.'"
				WHEN hb.block_type="M"
				THEN
				hb.month_date BETWEEN "'.$checkin_mday.'" and "'.$checkout_mday.'"
				END'
		;
		$availability = DB::select(DB::raw($query));
		return $availability;
	}

	public static function getUser($user_id) {
		$user = DB::table('users')
			->select('*')
			->where('id', $user_id)
			->first();
		return $user;
	}

	public static function getBookAddon($language_id, $hall_addon, $book_hall_id) {
		$result = array();
		foreach ($hall_addon as $key => $addon) {
			$result[$key] = DB::table('hall_addon_relation as har')
				->select('har.addon_id', 'har.addon_price', 'at.addon_name')
				->leftJoin('addon_translation as at', 'har.addon_id', '=', 'at.addon_id')
				->where('har.hall_id', $book_hall_id)
				->where('at.language_id', $language_id)
				->where('har.addon_id', $addon)
				->orderBy('at.addon_name', 'asc')
				->first();

		}

		return $result;
	}

	public static function getEmaildata($email_id, $language_id) {
		$result = DB::table('email_translation as et')
			->select('et.*')
			->where('et.email_id', $email_id)
			->where('et.language_id', $language_id)
			->first();
		return $result;
	}

	public static function getBookingdata($booking_id) {
		$result = DB::table('booking as b')
			->select('b.*')
			->where('b.booking_id', $booking_id)
			->first();
		return $result;
	}

	public static function getSettingdata($settings_id) {
		$result = DB::table('settings')
			->where('settings_id', $settings_id)
			->pluck('settings_value');
		return $result[0];
	}

	public static function getData($table, $select, $where_key, $where_val, $language_id) {
		if ($language_id != '') {
			$result = DB::table($table)
				->where($where_key, $where_val)
				->where('language_id', $language_id)
				->pluck($select);
		} else {
			$result = DB::table($table)
				->where($where_key, $where_val)
				->pluck($select);
		}
		return $result[0];
	}
	
	public static function myBooking()
	{
		$result = DB::table('booking as b')
			->select('b.*',DB::RAW("group_concat(concat(ev_ba.addon_name, ': ', ev_ba.addon_price) separator '<br>') as addons"))
			->leftJoin('book_addon as ba', 'ba.booking_id', '=', 'b.booking_id')
			->where('b.user_id',  Auth::user()->id)
			->groupBy('ba.booking_id')
			->get();
		return $result;
	}
	
	public static function bookingOnMyHall()
	{
		$result = DB::table('booking as b')
			->select('b.*',DB::RAW("group_concat(concat(ev_ba.addon_name, ': ', ev_ba.addon_price) separator '<br>') as addons"))
			->leftJoin('hall as hl', 'hl.id', '=', 'b.hall_id')
			->leftJoin('book_addon as ba', 'ba.booking_id', '=', 'b.booking_id')
			->where('hl.user_id', Auth::user()->id)
			->groupBy('ba.booking_id')
			->get();
		return $result;
	}
}
