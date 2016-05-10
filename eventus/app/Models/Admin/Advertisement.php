<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Advertisement extends Model
{
   	public static function totalRecord($select, $tablename, $where, $keywords)
	{		
		$query = DB::table($tablename.' as t');
	    $query->select($select);	     
	    $query->where($where);
		if($keywords){
			foreach($keywords as $key=>$val){
				if($key=='advertisement_title'){					
					if($val!=''){
						$query->where($key, 'LIKE', '%'.trim($val).'%');
					}
				}
			}			
		}	    
		$query->join('advertisement_translation as atrans', 't.id', '=', 'atrans.advertisement_id');
	    $totalRec = $query->count();
	    return $totalRec;
	}
	public static function MultiRecords($tablename,$where)
	{
		$data = DB::table($tablename)
					->where($where)->get();
	    return $data;
	}
	
	public static function totalGrid($select, $tablename, $where, $keywords, $orderBy, $order, $limit, $offset)
	{		
		$query = DB::table($tablename.' as t');
	    $query->select($select);	     
	    $query->where($where);
	    if($keywords){
			foreach($keywords as $key=>$val){
				if($key=='advertisement_title'){					
					if($key!=''){
						$query->where($key, 'LIKE', '%'.trim($val).'%');
					}
				}
			}
		}
		$query->join('advertisement_translation as atrans', 't.id', '=', 'atrans.advertisement_id');
	    $query->orderBy($orderBy, $order);
		$query->limit($limit);
		$query->offset($offset);
	    $totalRec = $query->get();
	    return $totalRec;
	}
		
	public static function orderUp($tablename, $pk, $current_order_id)
	{
		$previous= DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_advertisement where order_id < " . $current_order_id . ")"))->get();

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
		$next= DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_advertisement where order_id > " . $current_order_id . ")"))->get();

		DB::table($tablename)
						->where('id', $next[0]->id)
						->update(['order_id' => $next[0]->order_id - 1]);

		DB::table($tablename)
						->where('id', $pk)
						->update(['order_id' => $current_order_id + 1]);
		return;
	}
	
	public static function updateData($tablename, $data, $where)
	{
		$data = DB::table($tablename)
					->where($where)
					->update($data);
		return 1;
	}
	public static function maxOrderId($tablename){
		$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_advertisement)"))->get();
		return isset($max_order[0]->order_id)?$max_order[0]->order_id:0;
	}
	public static function minOrderId($tablename){
		$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_advertisement)"))->get();
		return isset($min_order[0]->order_id)?$min_order[0]->order_id:0;
	}
	public static function deleteData($tablename, $id) {
		
			$max_order = DB::table($tablename)->where('order_id', DB::raw("(select max(`order_id`) from ev_advertisement)"))->get();
			$min_order = DB::table($tablename)->where('order_id', DB::raw("(select min(`order_id`) from ev_advertisement)"))->get();
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
			
	public static function get_statistics($Search_from_date,$Search_to_date,$advertisement_id){
		$sql = "SELECT i.date_of_action AS X,COUNT(i.advertisement_id) AS Y FROM ev_advertisement_impression i WHERE i.date_of_action BETWEEN '".$Search_from_date."' AND '".$Search_to_date."' AND i.advertisement_id=".$advertisement_id." GROUP BY(i.date_of_action)";
					
		$statisticsArr = DB::select(DB::raw($sql));
		return $statisticsArr;
	}
	
	public static function get_clicks($Search_from_date,$Search_to_date,$advertisement_id){
		$sql = "SELECT i.date AS X,COUNT(i.advertisement_id) AS click FROM ev_advertisement_impression_click i WHERE i.date BETWEEN '".$Search_from_date."' AND '".$Search_to_date."' AND i.advertisement_id=".$advertisement_id." GROUP BY(i.date)";		
		$statisticsArr = DB::select(DB::raw($sql));
		return $statisticsArr;		
	}
	
	public static function getCountData($tablename,$fromDate,$todate,$id,$countColumn,$dateColumn){
		$sql = "SELECT COUNT(".$countColumn.") AS count FROM ".$tablename." WHERE advertisement_id=".$id." AND ".$dateColumn." BETWEEN '".$fromDate."' AND '".$todate."'";
			
		$returnData = DB::select(DB::raw($sql));
		return $returnData[0];
	}	
	
}
