<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

/**
 * Class PersonContact
 * @package App\Models
 */
class PersonContact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_id', 'contact_type', 'contact'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'person_id',
    ];

    /**
     * @param $value
     * @return string
     */
    public function getContactTypeAttribute($value): string
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
}
