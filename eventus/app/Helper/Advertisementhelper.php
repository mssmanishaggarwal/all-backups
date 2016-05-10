<?php 
namespace App\Helper;
use DB;

class Advertisementhelper {
	
	public function advertisement($language_id){
		$getTotaladvertise = $this->getDistinctrecords('advertisement','id', $where = array('is_active'=>1));
		
		$getDistinctAds = $this->getDistinctrecords('advertisement_impression','advertisement_id', $where = array('date_of_action'=>date('Y-m-d')));
		
		$advertiseArr = array();
		foreach($getTotaladvertise as $advertise){
			array_push($advertiseArr,$advertise->id);
		}
		
		$x = 0;
		foreach($getDistinctAds as $ads){
			if(in_array($ads->advertisement_id,$advertiseArr)){
				$x++;
			}
		}		
		
		if($x != count($advertiseArr)){			
			$ids = array();
			foreach($getDistinctAds as $val){
				array_push($ids,$val->advertisement_id);
			}
			$ids = implode(',',$ids);
			$advertiseArr = $this->getRandomrecord($ids,$language_id);
			
			
		}else{
			$advertiseArr = $this->getAdvertisement($language_id);
		}
		
		if(count($advertiseArr))
		{
			$insertId = DB::table('advertisement_impression')
					->insertGetId(
					['advertisement_id' => $advertiseArr[0]->id,
					 'date_of_action' => date('Y-m-d'),
					 'time_of_action' => date('Y-m-d H:i:s')
					]);
		return $advertiseArr[0];
		}
		
		else
		return $advertiseArr;
		
		
		
	}
	
	public function getDistinctrecords($tableName,$fieldName,$where){
		
		$advertiseArr = DB::table($tableName)
				->select($fieldName)
				->distinct($fieldName)
				->where($where)
				->get();
	 	
		return $advertiseArr;
	}
	
	public function getRandomrecord($ids,$language_id){
		$sql = "SELECT * FROM ev_advertisement as adv
				JOIN ev_advertisement_translation as advt ON adv.id = advt.advertisement_id
				WHERE adv.is_active=1 and advt.language_id=".$language_id;
		if($ids != ''){
			$sql .= " AND adv.id NOT IN(".$ids.")";
		}
		$sql .= " ORDER BY RAND() LIMIT 1";
		
	 	$advertiseArr =  DB::select(DB::raw($sql));			
		return $advertiseArr;
	}
	
	public function getAdvertisement($language_id){
		$sql = "SELECT w.*,COUNT(i.advertisement_id) AS tcount FROM ev_advertisement w 
				JOIN ev_advertisement_translation advt ON w.id = advt.advertisement_id
				JOIN ev_advertisement_impression i ON w.id= i.advertisement_id 
				WHERE w.is_active=1 AND advt.language_id=".$language_id." AND i.date_of_action IN('".date('Y-m-d')."') 
				GROUP BY (w.id) ORDER BY tcount ASC LIMIT 1";		
	 		
		$advertiseArr = DB::select(DB::raw($sql));
		return $advertiseArr;
	}
 
}

?>