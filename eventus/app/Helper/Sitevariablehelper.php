<?php 
namespace App\Helper;
use DB;

class Sitevariablehelper {
	
	public static function setVariables($language_id,$globalvariable_key){
		$query = DB::table('sitevariable as var');
		$query->select('val.variable_value');
		$query->join('sitevariable_value as val','var.sitevariable_id','=','val.sitevariable_id');
		$query->where('var.sitevariable_key',$globalvariable_key);
		$query->where('val.language_id',$language_id);
		$result = $query->first();
		return $result->variable_value;
	}
 
}

?>