<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'ads_zipcode', 'ads_street', 'ads_number', 'ads_neighborhood', 'ads_complement', 'ads_city', 'ads_state'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(PersonContact::class, 'person_id', 'id');
    }

    public function getFullAddress()
    {
        $address = "{$this->ads_street}, {$this->ads_neighborhood}, {$this->ads_number}, {$this->ads_city} - {$this->ads_state} - {$this->ads_zipcode}";
        return $address;
    }
}
