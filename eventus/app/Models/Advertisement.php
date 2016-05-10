<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = ['advertisement_link','position_id','is_active','start_date','end_date'];
    protected $table = 'advertisement';
     
     public function advertisement()
     {
	 	return $this->belongsToMany('App\Models\AdvertisementTranslation','advertisement_translation','id','advertisement_translation_id');
	 	
	 }
	 public function missions() {
        return $this->hasMany('App\Models\AdvertisementTranslation');
    }
}
