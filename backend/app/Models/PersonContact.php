<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonContact
 * @package App\Models
 */
class PersonContact extends Model
{
    use SoftDeletes;

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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'person_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * @param $value
     * @return string
     */
    public function getContactTypeAttribute($value)
    {
        switch ($value) {
            case 1:
                return 'WhatsApp';
            case 2:
                return 'Telefone';
            case 3:
                return 'E-mail';
        }
    }

    public function setContactAttribute($value)
    {
        if ($this->contact_type != 'E-mail') {
            $this->attributes['contact'] = StringHelper::clearField($value);
        } else {
            $this->attributes['contact'] = $value;
        }
    }
}
