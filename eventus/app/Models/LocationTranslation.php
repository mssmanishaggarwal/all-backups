<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationTranslation extends Model
{
   protected $fillable = ['location_id','location_name'];
    protected $table = 'location_translation';
    public function launchSite() {
        return $this->belongsTo('App\Models\Location','location_id');
    }
}
