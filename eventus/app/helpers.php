<?php
use Illuminate\Http\Request;

function admins() {
	return auth()->guard(config('auth.defaults.admins_guard'));
}

function isActiveRoute($route, $output = "active") {

	if (Route::getCurrentRoute()->getPath() == $route) {
		return $output;
	}

}

function areActiveRoutes(Array $routes, $output = "active") {
	foreach ($routes as $route) {
		if (Route::getCurrentRoute()->getPath() == $route) {
			return $output;
		}

	}

}

function isActiveLang($lang_id)
{
	$request = request();
	$language_id = $request->session()->get('language_id');
	if($language_id == $lang_id)
	return 'active';
	else
	return '';
}

function dateFormat($dateVal) {
	$date = date("d/m/Y", strtotime($dateVal));
	return $date;
}

function dateTimeFormat($dateVal) {
	$date = date("d/m/Y, h:i:s", strtotime($dateVal));
	return $date;
}

function dateFormatDB($dateVal) {
	$date = date("Y-m-d", strtotime(str_replace('/', '-', $dateVal)));
	return $date;
}

function dateTimeFormatDB($dateVal) {
	$date = date("Y-m-d H:i:s", strtotime($dateVal));
	return $date;
}

function setCurrency($val)
{
	$request = request();
	$currency_id = $request->session()->get('currency_id');
	if($currency_id == 2)
	{
		$changeRate = DB::table('settings')->where('settings_id', 16)->pluck('settings_value');
		$currency_val = number_format($val * $changeRate[0],2).' EUR';		
	}
	else
	{
		$currency_val = $val.' AOA';
	}
	return $currency_val;
}

function craeteBreadcrumb($breadcrumb) {
	$str = '';
	$total = count($breadcrumb);
	$i = 0;
	foreach ($breadcrumb as $key => $val) {
		$i++;
		if ($total != $i) {
			$str .= '<a href="' . $val . '"><span>' . $key . '</span></a>';
		} else {
			$str .= '<span class="current">' . $key . '</span>';
		}

	}

	return $str;
}

function checkFavourite($hall_id) {
	$user_id = Auth::user()->id;
	$favorite_id = DB::table('favorite as f')
		->where('f.hall_id', $hall_id)
		->where('f.user_id', $user_id)
		->pluck('favorite_id');

	if ($favorite_id) {
		return 1;
	} else {
		return 0;
	}

}
function subscriptionAvailability($past_hall_id) {
	$returnable = DB::select(DB::raw("SELECT DATEDIFF(expiry_date,NOW()) AS duration FROM `ev_hall_subscription_relation` WHERE `payment_status`='1' AND
		`hall_id`='" . $past_hall_id . "' ORDER BY `id` DESC LIMIT 0,1"));
	if ($returnable) {
		return $returnable[0]->duration;
	} else {
		return 'notfound';
	}

}

function getMessage() {
	$query = DB::select(DB::raw("select * from `ev_messages` where `msg_parent_id` = '0' and (`from_user_id` = '" . Auth::user()->id . "' or `to_user_id` = '" . Auth::user()->id . "') order by `msgpost_datetime` desc"));

	return $query;
}
function getUserName($user_id) {
	$query = DB::table('users');
	$query->select('first_name', 'last_name', 'email');
	$query->where('id', '=', $user_id);
	$return = $query->get();
	return $return;
}
function getHallName($hall_id) {
	$query = DB::table('hall_translation');
	$query->select('hall_name');
	$query->where('language_id', '=', 1);
	$query->where('hall_id', '=', $hall_id);
	$return = $query->get();
	return $return;
}
function replyCount($parent_id) {
	$query = DB::select(DB::raw("SELECT COUNT(*) AS `cnt` FROM `ev_messages` WHERE msg_parent_id= '" . $parent_id . "'"));
	return $query;
}
function notifyCountReply($parent_id) {
	$query = DB::select(DB::raw("SELECT COUNT(*) AS `cnt` FROM `ev_messages` WHERE to_user_id='" . Auth::user()->id . "' AND msg_parent_id= '" . $parent_id . "' AND is_viewed='N'"));
	return $query;
}
function notifyAtMenu() {
	$query = DB::select(DB::raw("SELECT COUNT(*) AS `cnt` FROM `ev_messages` WHERE to_user_id='" . Auth::user()->id . "'  AND is_viewed='N'"));
	return $query;
}
function make_read_parent_message() {
	DB::table('messages')
		->where('to_user_id', '=', Auth::user()->id)
		->where('msg_parent_id', '=', 0)
		->update(
			['is_viewed' => 'Y']
		);
}
function make_read($msg_id, $from_user_id) {
	//DB::update(DB::raw())
	DB::table('messages')
		->where('from_user_id', '=', $from_user_id)
		->where('to_user_id', '=', Auth::user()->id)
		->where('msg_id', '=', $msg_id)
		->update(
			['is_viewed' => 'Y']
		);
}
function getReplyListing($parent_id) {
	$query = DB::select(DB::raw("select * from `ev_messages` where `msg_parent_id` = '" . $parent_id . "' order by `msgreply_datetime` asc"));
	return $query;
}

function getMetaValue($cms_id, $select, $language_id) {
	$meta = DB::table('cms_data')
		->where('cms_id', $cms_id)
		->where('language_id', $language_id)
		->pluck($select);

	return $meta[0];
}

function getallHallType($language_id)
{	
	$halltype = DB::table('hall_type as ht')
		->select('ht.id','htrans.hall_type_name')
		->join('hall_type_translation as htrans', 'ht.id', '=', 'htrans.hall_type_id')
		->where('ht.is_active', 1)
		->where('htrans.language_id', $language_id)
		->orderBy('ht.order_id')
		->get();
	
	return $halltype;
	
}

?>