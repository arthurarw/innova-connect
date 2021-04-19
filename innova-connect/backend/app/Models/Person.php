<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Person
 * @package App\Models
 */
class Person extends Model
{
    use HasFactory, SoftDeletes, SoftCascadeTrait;

    /**
     * @var string
     */
    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'ads_zipcode', 'ads_street', 'ads_number', 'ads_neighborhood', 'ads_city', 'ads_state'
    ];


    /**
     * @var string[]
     */
    protected $softCascade = ['contacts'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(PersonContact::class, 'person_id', 'id');
    }

    /**
     * @return string
     */
    public function getFullAddress()
    {
        $address = "{$this->ads_street}, {$this->ads_neighborhood}, {$this->ads_number}, {$this->ads_city} - {$this->ads_state} - {$this->ads_zipcode}";
        return $address;
    }

    /**
     * @param $value
     */
    public function setAdsZipcodeAttribute($value) {
        $this->attributes['ads_zipcode'] = StringHelper::clearField($value);
    }
}
