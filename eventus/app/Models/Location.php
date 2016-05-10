<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
     protected $fillable = ['is_active'];
     protected $table = 'location';
     
     public function location()
     {
	 	return $this->belongsToMany('App\Models\LocationTranslation','location_translation','location_id','location_translation_id');
	 	
	 }
	 public function missions() {
        return $this->hasMany('App\Models\LocationTranslation');
    }
}
