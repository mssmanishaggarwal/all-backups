<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTranslation extends Model
{
    protected $fillable = ['subscription_id','subscription_name','language_id'];
    protected $table = 'subscription_translation';
    public function launchSite() {
        return $this->belongsTo('App\Models\Subscription','id');
    }
}
