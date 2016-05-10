<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddonTranslation extends Model
{
    protected $fillable = ['addon_id','addon_name'];
    protected $table = 'addon_translation';
    public function launchSite() {
        return $this->belongsTo('App\Models\Addon','id');
    }
}
