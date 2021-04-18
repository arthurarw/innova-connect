<?php


namespace App\Services;


use App\Exceptions\PersonContactNotFoundException;
use App\Models\PersonContact;

/**
 * Class PersonContactService
 * @package App\Services
 */
class PersonContactService
{
    /**
     * @param $id
     * @return mixed
     * @throws PersonContactNotFoundException
     */
    public function show($id)
    {
        $contact = PersonContact::where('id', $id)->first();
        if (!$contact) {
            throw new PersonContactNotFoundException();
        }

        return $contact;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return PersonContact::create([
            'person_id' => $data['person_id'],
            'contact_type' => $data['contact_type'],
            'contact' => $data['contact']
        ]);
    }

    /**
     * @param array $data
     * @param PersonContact $personContact
     * @return PersonContact|null
     * @throws \Throwable
     */
    public function update(array $data, PersonContact $personContact)
    {
        $personContact->fill($data);
        $personContact->saveOrFail();

        return $personContact->fresh();
    }

}
