<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Payment extends Model
{
   	public static function totalRecord($select, $tablename, $where, $keywords)
	{		
		$query = DB::table($tablename.' as t');
	    $query->select($select);	     
	    $query->where($where);
		if($keywords){
			foreach($keywords as $key=>$val){
				if($key=='payment_number'){					
					if($val!=''){
						$query->where($key, '=', trim($val));
					}
				}
				
				if($key=='payment_status'){					
					if($val!=''){
						$query->where($key, '=', $val);
					}
				}
				
				if($key=='payment_for'){					
					if($val!=''){
						$query->where($key, '=', $val);
					}
				}
				
			}			
		}		
	    $totalRec = $query->count();
	    return $totalRec;
	}
	
	public static function totalGrid($select, $tablename, $where, $keywords, $orderBy, $order, $limit, $offset)
	{		
		$query = DB::table($tablename.' as t');
	    $query->select($select);	     
	    $query->where($where);
	    if($keywords){
			foreach($keywords as $key=>$val){
				if($key=='payment_number'){					
					if($val!=''){
						$query->where($key, '=', trim($val));
					}
				}
				
				if($key=='payment_status'){					
					if($val!=''){
						$query->where($key, '=', $val);
					}
				}
				
				if($key=='payment_for'){					
					if($val!=''){
						$query->where($key, '=', $val);
					}
				}
			}
		}		
	    $query->orderBy($orderBy, $order);
		$query->limit($limit);
		$query->offset($offset);
	    $totalRec = $query->get();
	    return $totalRec;
	}
		
	/*public static function orderUp($tablename, $pk, $current_order_id)
	{
		$previous= DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_accommodation where order_id < " . $current_order_id . ")"))->get();

		DB::table($tablename)
						->where('id', $previous[0]->id)
						->update(['order_id' => $previous[0]->order_id + 1]);

		DB::table($tablename)
						->where('id', $pk)
						->update(['order_id' => $current_order_id-1]);
		return;
	}
	
	public static function orderDown($tablename, $pk, $current_order_id)
	{
		$next= DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_accommodation where order_id > " . $current_order_id . ")"))->get();

		DB::table($tablename)
						->where('id', $next[0]->id)
						->update(['order_id' => $next[0]->order_id - 1]);

		DB::table($tablename)
						->where('id', $pk)
						->update(['order_id' => $current_order_id + 1]);
		return;
	}*/
	
	public static function updateData($tablename, $data, $where)
	{
		$data = DB::table($tablename)
					->where($where)
					->update($data);
		return 1;
	}
	/*public static function maxOrderId($tablename){
		$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_accommodation)"))->get();
		return $max_order[0]->order_id;
	}
	public static function minOrderId($tablename){
		$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_accommodation)"))->get();
		return $min_order[0]->order_id;
	}
	public static function deleteData($tablename, $id) {
		
			$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_accommodation)"))->get();
			$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_accommodation)"))->get();
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
			}*/
}
