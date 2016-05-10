<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class User extends Model
{
   	public static function totalRecord($select, $tablename, $where, $keywords)
	{		
		$query = DB::table($tablename.' as t');
	    $query->select($select);	     
	    $query->where($where);
		if($keywords){
			foreach($keywords as $key=>$val){
				if($key=='email'){					
					if(trim($val)!=''){
						$query->where($key, 'LIKE', '%'.trim($val).'%');
					}						
				}
				if($key=='first_name'){					
					if(trim($val)!=''){
						$query->where(DB::RAW('CONCAT(ev_t.first_name," ",ev_t.last_name)'), 'LIKE', '%'.trim($val).'%');
					}
				}
				if($key=='contact_number'){									
					if(trim($val)!=''){
						$query->where($key, '=', trim($val));
					}
				}
				if($key=='postcode'){					
					if(trim($val)!=''){
						$query->where($key, '=', $val);
					}
				}
				if($key=='user_type'){					
					if(trim($val)!=''){
						$query->where($key, '=', $val);
					}
				}
				
				if($key=='city'){					
					if(trim($val)!=''){
						$query->where($key, '=', $val);
					}
				}
				
				if($key=='state'){					
					if(trim($val)!=''){
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
				if($key=='email'){					
					if(trim($val)!=''){
						$query->where($key, 'LIKE', '%'.trim($val).'%');
					}						
				}
				if($key=='first_name'){					
					if(trim($val)!=''){
						$query->where(DB::RAW('CONCAT(ev_t.first_name," ",ev_t.last_name)'), 'LIKE', '%'.trim($val).'%');
					}
				}
				if($key=='contact_number'){									
					if(trim($val)!=''){
						$query->where($key, '=', trim($val));
					}
				}
				if($key=='postcode'){					
					if(trim($val)!=''){
						$query->where($key, '=', $val);
					}
				}
				if($key=='user_type'){					
					if(trim($val)!=''){
						$query->where($key, '=', $val);
					}
				}
				
				if($key=='city'){					
					if(trim($val)!=''){
						$query->where($key, '=', $val);
					}
				}
				
				if($key=='state'){					
					if(trim($val)!=''){
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
		
	public static function orderUp($tablename, $pk, $current_order_id)
	{
		$previous= DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_user where order_id < " . $current_order_id . ")"))->get();

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
		$next= DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_user where order_id > " . $current_order_id . ")"))->get();

		DB::table($tablename)
						->where('id', $next[0]->id)
						->update(['order_id' => $next[0]->order_id - 1]);

		DB::table($tablename)
						->where('id', $pk)
						->update(['order_id' => $current_order_id + 1]);
		return;
	}
	public static function MultiRecords($tablename,$where)
	{
		$data = DB::table($tablename)
					->where($where)->get();
	    return $data;
	}
	public static function updateData($tablename, $data, $where)
	{
		$data = DB::table($tablename)
					->where($where)
					->update($data);
		return 1;
	}
	public static function maxOrderId($tablename){
		$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_user)"))->get();
		return isset($max_order[0]->order_id)?$max_order[0]->order_id:0;
	}
	public static function minOrderId($tablename){
		$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_user)"))->get();
		return isset($min_order[0]->order_id)?$min_order[0]->order_id:0;
	}
	public static function deleteData($tablename, $id) {
		
			//$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_user)"))->get();
			//$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_user)"))->get();
			//$order = DB::table($tablename)->where('id', $id)->get();

				/*if ($order[0]->order_id == $min_order[0]->order_id) {

					DB::table($tablename)
						->where('order_id', '>', $order[0]->order_id)					
						->decrement('order_id');

				} elseif ($order[0]->order_id > $min_order[0]->order_id && $order[0]->order_id < $max_order[0]->order_id) {

					DB::table($tablename)
						->where('order_id', '>', $order[0]->order_id)
						->decrement('order_id');

				}*/
				DB::table($tablename)->where('id', $id)->delete();				
			}
}
