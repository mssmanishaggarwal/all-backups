<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricerange extends Model
{
    protected $fillable = ['currency_id','lower_range','upper_range','is_active'];
     protected $table = 'price_range';
     
     public function price_range()
     {
	 	return $this->belongsToMany('App\Models\PricerangeTranslation','price_range_translation','id','price_range_translation_id');
	 	
	 }
	 public function missions() {
        return $this->hasMany('App\Models\PricerangeTranslation');
    }
}
