<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricerangeTranslation extends Model
{
    protected $fillable = ['price_range_id','price_range_title','language_id'];
    protected $table = 'price_range_translation';
    public function launchSite() {
        return $this->belongsTo('App\Models\Pricerange','id');
    }
}
