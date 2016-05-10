<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementTranslation extends Model
{
    protected $fillable = ['advertisement_id','advertisement_title','language_id'];
    protected $table = 'advertisement_translation';
    public function launchSite() {
        return $this->belongsTo('App\Models\Advertisement','id');
    }
}
