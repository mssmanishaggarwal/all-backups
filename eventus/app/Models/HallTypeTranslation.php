<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallTypeTranslation extends Model
{
    protected $fillable = ['hall_type_id','hall_type_name'];
    protected $table = 'hall_type_translation';
    public function launchSite() {
        return $this->belongsTo('App\Models\HallType','id');
    }
    
   
}
