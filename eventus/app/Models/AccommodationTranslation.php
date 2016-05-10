<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccommodationTranslation extends Model
{
    protected $fillable = ['accommodation_id','accommodation_name'];
    protected $table = 'accommodation_translation';
    public function launchSite() {
        return $this->belongsTo('App\Models\Accommodation','id');
    }
}
