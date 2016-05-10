<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Sitevariable extends Model
{
	public static function totalRecord($select, $tablename, $where, $keywords) {		
		$query = DB::table($tablename.' as t');
	  $query->select($select);
		$query->join('sitevariable_value as atrans', 't.sitevariable_id', '=', 'atrans.sitevariable_id');	     
	  $query->where($where);
		if($keywords){
			foreach($keywords as $key=>$val) {
				if($key=='sitevariable_name') {					
					if($val != '') {
						$query->where($key, 'LIKE', '%'.trim($val).'%');
					}
				}
			}			
		}	    
	  $totalRec = $query->count();
	  return $totalRec;
	}
	
	public static function totalGrid($select, $tablename, $where, $keywords, $orderBy, $order, $limit, $offset) {		
		$query = DB::table($tablename.' as t');
	  $query->select($select);
		$query->join('sitevariable_value as atrans', 't.sitevariable_id', '=', 'atrans.sitevariable_id');	     
	  $query->where($where);
		if($keywords){
			foreach($keywords as $key=>$val) {
				if($key=='sitevariable_name') {					
					if($val != '') {
						$query->where($key, 'LIKE', '%'.trim($val).'%');
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

	public static function updateData($tablename, $data, $where) {
		$data = DB::table($tablename)
  		->where($where)
			->update($data);
		return 1;
	}
}
