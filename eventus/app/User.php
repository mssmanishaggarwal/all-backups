<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $fillable = [
		'first_name', 'last_name', 'email', 'password', 'contact_number', 'address', 'city', 'state', 'postcode', 'email_auth', 'country', 'is_active', 'profile_image',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
}
