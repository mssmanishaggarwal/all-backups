<?php

namespace App\Models\Admin;

use DB;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model {
	public static function totalRecord($select, $tablename, $where, $keywords) {
		$query = DB::table($tablename . ' as t');
		$query->select('t.'.$select, 'usr.first_name', 'usr.last_name', 'usr.email', 'usr.contact_number', 'atrans.hall_name', 'loctrans.location_name', 'provtrans.province_name', 'hsr.subscription_name', 'hsr.start_date', 'hsr.expiry_date');
		$query->join('hall_translation as atrans', 't.id', '=', 'atrans.hall_id');
		$query->leftJoin('location_translation as loctrans', 'loctrans.location_id', '=', 't.location_id');
		$query->leftJoin('province as provtrans', 'provtrans.id', '=', 't.hall_province');
		$query->leftJoin('users as usr', 'usr.id', '=', 't.user_id');
		$query->leftJoin(DB::RAW('(select * from ev_hall_subscription_relation as ev_subrel where ev_subrel.start_date <= CURDATE() AND ev_subrel.expiry_date >= CURDATE() group by ev_subrel.hall_id) ev_hsr'), 'hsr.hall_id', '=', 't.id');
		$query->where($where);
				
		if ($keywords) {							
					if ($keywords['hall_name'] != '') {
						$query->where('atrans.hall_name', 'LIKE', '%' . trim($keywords['hall_name']) . '%');
					}
									
					if ($keywords['user_name'] != '') {
						$query->where(DB::RAW('CONCAT(ev_usr.first_name," ",ev_usr.last_name)'), 'LIKE', '%'.trim($keywords['user_name']).'%');
					}
				
				if ($keywords['location_id'] != '') {					
						$query->where('t.location_id', '=', $keywords['location_id']);
					}
					
				if ($keywords['hall_province'] != '') {					
						$query->where('t.hall_province', '=', $keywords['hall_province']);
					}
				
				if ($keywords['date_type'] != '') 
					{
						if ($keywords['from_date'] != '')				
						$query->where('t.created_at', '<=', $keywords['from_date']);
						if ($keywords['to_date'] != '')
						$query->where('t.created_at', '>=', $keywords['to_date']);
					}				
		}
		
		$totalRec = $query->count();
		return $totalRec;
	}

	public static function totalGrid($select, $tablename, $where, $keywords, $orderBy, $order, $limit, $offset) {
		$query = DB::table($tablename . ' as t');
		$query->select('t.'.$select, 'usr.first_name', 'usr.last_name', 'usr.email', 'usr.contact_number', 'atrans.hall_name', 'loctrans.location_name', 'provtrans.province_name', 'hsr.subscription_name', 'hsr.start_date', 'hsr.expiry_date');
		$query->join('hall_translation as atrans', 't.id', '=', 'atrans.hall_id');
		$query->leftJoin('location_translation as loctrans', 'loctrans.location_id', '=', 't.location_id');
		$query->leftJoin('province as provtrans', 'provtrans.id', '=', 't.hall_province');
		$query->leftJoin('users as usr', 'usr.id', '=', 't.user_id');
		$query->leftJoin(DB::RAW('(select * from ev_hall_subscription_relation as ev_subrel where ev_subrel.start_date <= CURDATE() AND ev_subrel.expiry_date >= CURDATE() group by ev_subrel.hall_id) ev_hsr'), 'hsr.hall_id', '=', 't.id');
		$query->where($where);
		
		//$query->where(DB::RAW('CURDATE() BETWEEN ev_subrel.start_date AND ev_subrel.expiry_date'));
		if ($keywords) {							
					if ($keywords['hall_name'] != '') {
						$query->where('atrans.hall_name', 'LIKE', '%' . trim($keywords['hall_name']) . '%');
					}
									
					if ($keywords['user_name'] != '') {
						$query->where(DB::RAW('CONCAT(ev_usr.first_name," ",ev_usr.last_name)'), 'LIKE', '%'.trim($keywords['user_name']).'%');
					}
				
				if ($keywords['location_id'] != '') {					
						$query->where('t.location_id', '=', $keywords['location_id']);
					}
					
				if ($keywords['hall_province'] != '') {					
						$query->where('t.hall_province', '=', $keywords['hall_province']);
					}
				
				if ($keywords['date_type'] == 'A') 
					{
						if ($keywords['from_date'] != '' && $keywords['to_date'] == '')				
						$query->where('t.created_at', '>=', $keywords['from_date']);
						if ($keywords['from_date'] == '' && $keywords['to_date'] != '')
						$query->where('t.created_at', '<=', $keywords['to_date']);
						if ($keywords['from_date'] != '' && $keywords['to_date'] != '')
						$query->whereBetween('t.created_at', [$keywords['from_date'],$keywords['to_date']]);
					}
					
				if ($keywords['date_type'] == 'E') 
					{
						if ($keywords['from_date'] != '' && $keywords['to_date'] == '')				
						$query->where('hsr.expiry_date', '>=', $keywords['from_date']);
						if ($keywords['from_date'] == '' && $keywords['to_date'] != '')
						$query->where('hsr.expiry_date', '<=', $keywords['to_date']);
						if ($keywords['from_date'] != '' && $keywords['to_date'] != '')
						$query->whereBetween('hsr.expiry_date', [$keywords['from_date'],$keywords['to_date']]);
					}				
		}
		
		$query->orderBy($orderBy, $order);
		$query->limit($limit);
		$query->offset($offset);
		$totalRec = $query->get();
		return $totalRec;
	}

	public static function orderUp($tablename, $pk, $current_order_id) {
		$previous = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_hall where order_id < " . $current_order_id . ")"))->get();

		DB::table($tablename)
			->where('id', $previous[0]->id)
			->update(['order_id' => $previous[0]->order_id + 1]);

		DB::table($tablename)
			->where('id', $pk)
			->update(['order_id' => $current_order_id - 1]);
		return;
	}

	public static function orderDown($tablename, $pk, $current_order_id) {
		$next = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_hall where order_id > " . $current_order_id . ")"))->get();

		DB::table($tablename)
			->where('id', $next[0]->id)
			->update(['order_id' => $next[0]->order_id - 1]);

		DB::table($tablename)
			->where('id', $pk)
			->update(['order_id' => $current_order_id + 1]);
		return;
	}
	public static function MultiRecords($tablename, $where) {
		$data = DB::table($tablename)
			->where($where)->get();
		return $data;
	}
	public static function updateData($tablename, $data, $where) {
		$data = DB::table($tablename)
			->where($where)
			->update($data);
		return 1;
	}
	public static function maxOrderId($tablename) {
		$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_hall)"))->get();
		return isset($max_order[0]->order_id)?$max_order[0]->order_id:0;
	}
	public static function minOrderId($tablename) {
		$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_hall)"))->get();
		return isset($min_order[0]->order_id)?$min_order[0]->order_id:0;
	}
	public static function deleteData($tablename, $id) {

		$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_hall)"))->get();
		$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_hall)"))->get();
		$order = DB::table($tablename)->where('id', $id)->get();

		if ($order[0]->order_id == $min_order[0]->order_id) {

			DB::table($tablename)
				->where('order_id', '>', $order[0]->order_id)
				->decrement('order_id');

		} elseif ($order[0]->order_id > $min_order[0]->order_id && $order[0]->order_id < $max_order[0]->order_id) {

			DB::table($tablename)
				->where('order_id', '>', $order[0]->order_id)
				->decrement('order_id');

		}
		DB::table($tablename)->where('id', $id)->delete();
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
	public static function subscriptionAvailability($past_hall_id) {
		$returnable = DB::select(DB::raw("SELECT `expiry_date` FROM `ev_hall_subscription_relation` WHERE `payment_status`='1' AND
		`hall_id`='" . $past_hall_id . "' ORDER BY `id` DESC LIMIT 0,1"));
		if ($returnable) {
			return $returnable[0]->expiry_date;
		}

	}
	
	public static function getHallUser($id)
	{
		$user_id = DB::table('hall')
				->where('id',$id)
				->pluck('user_id');
		return $user_id[0];
	}
}
