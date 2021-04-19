<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

/**
 * Class PersonContact
 * @package App\Models
 */
class PersonContact extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact',
        'person_id',
        'contact_type'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }


    /**
     * @param $value
     */
    public function setContactAttribute($value)
    {
        if ($this->contact_type != 3) {
            $this->attributes['contact'] = StringHelper::clearField($value);
        } else {
            $this->attributes['contact'] = $value;
        }
    }

    /**
     * @param $value
     * @return array|string|string[]
     */
    public function getContactAttribute($value)
    {
        if ($this->contact_type != 3) {
            return StringHelper::formatPhoneNumber($value);
        }

        return $value;
    }
}
