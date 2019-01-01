<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'id', 'name', 'value', 'user_id', 'user_id', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

	public function user(){
		return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}
}
