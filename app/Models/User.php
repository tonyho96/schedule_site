<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'company_name', 'country_type', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function settings(){
		return $this->hasMany('App\Models\Setting', 'user_id', 'id');
	}

	public function getSetting($name) {
		$settings = $this->settings;
		foreach ($settings as $setting) {
			if ($setting->name == $name)
				return $setting->value;
		}
		return null;
	}
}
