<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['subscription_month','subscription_price','is_active'];
     protected $table = 'subscription';
     
     public function subscription()
     {
	 	return $this->belongsToMany('App\Models\SubscriptionTranslation','subscription_translation','id','subscription_translation_id');
	 	
	 }
	 public function missions() {
        return $this->hasMany('App\Models\SubscriptionTranslation');
    }
}
