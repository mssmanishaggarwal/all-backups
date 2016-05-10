<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
     protected $fillable = ['is_active'];
     protected $table = 'accommodation';
     
     public function accommodation()
     {
	 	return $this->belongsToMany('App\Models\AccommodationTranslation','accommodation_translation','id','accommodation_translation_id');
	 	
	 }
	 public function missions() {
        return $this->hasMany('App\Models\AccommodationTranslation');
    }
}
