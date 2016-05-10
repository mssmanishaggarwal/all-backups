<?php 
namespace App\Helper;

use App\User; 
use App\Models\Role; 
use DB;

class Languagehelper{
 
   public static function getLanguage() 
   {			
		$language = DB::select(DB::raw('SELECT * FROM ev_language'));
		return $language;
	}
	
	public static function getDefaultLanguage()
	{
		$query = DB::table('language');
		$query->select('*');
		$query->where('is_default','Y');
		$result = $query->first();
		return $result->id;
	}
 
}

?>