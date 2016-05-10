<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model {
	//protected $fillable = ['is_active'];
	protected $table = 'hall';
	protected $fillable = [
		'hall_name', 'hall_description', 'hall_address', 'hall_city', 'hall_province', 'hall_postcode', 'hall_country', 'rental_amount', 'is_active',
	];

	/*public function accommodation()
		     {
			 	return $this->belongsToMany('App\Models\AccommodationTranslation','accommodation_translation','id','accommodation_translation_id');

			 }
			 public function missions() {
		        return $this->hasMany('App\Models\AccommodationTranslation');
	*/
}