<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
	protected $table = 'breeds';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'id', 'name'
    ];

    public $timestamps = false;

    public function pet(){
        return $this->hasOne('App\Models\Pet');
    }
}
