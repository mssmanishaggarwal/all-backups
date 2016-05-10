<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallType extends Model
{
     protected $fillable = ['is_active'];
     protected $table = 'hall_type';
     
     public function hall_type()
     {
	 	return $this->belongsToMany('App\Models\HallTypeTranslation','hall_type_translation','id','hall_type_translation_id');
	 	
	 }
	 public function missions() {
        return $this->hasMany('App\Models\HallTypeTranslation');
    }
   

	 
	
}
