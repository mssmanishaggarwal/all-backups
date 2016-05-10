<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable = ['is_active'];
    protected $table = 'addon';
     
     public function hall_type()
     {
	 	return $this->belongsToMany('App\Models\AddonTranslation','addon_translation','id','addon_translation_id');
	 	
	 }
	 public function missions() {
        return $this->hasMany('App\Models\AddonTranslation');
    }
}
