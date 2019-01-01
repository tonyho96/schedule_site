<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
     use Notifiable;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'name','breed_id', 'dob', 'gender', 'is_neutered', 'image_url','note', 'cut_note', 'alternative_contact_name', 'alternative_contact_number', 'vet_name', 'vet_number', 'vet_address', 'vet_medical_note', 'owner_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function breed()
    {

        return $this->belongsTo('App\Models\Breed');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

}
