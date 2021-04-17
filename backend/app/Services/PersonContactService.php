<?php


namespace App\Services;


use App\Exceptions\PersonNotFoundException;
use App\Models\Person;
use App\Models\PersonContact;

class PersonContactService
{

    public function create(array $data)
    {
        return PersonContact::create([
            'person_id' => $data['person_id'],
            'contact_type' => $data['contact_type'],
            'contact' => $data['contact']
        ]);
    }

}
