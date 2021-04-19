<?php


namespace App\Services;


use App\Exceptions\PersonNotFoundException;
use App\Models\Person;

class PersonService
{
    public function listAll()
    {
        return Person::all()->load('contacts');
    }

    public function show($id)
    {
        $person = Person::where('id', $id)->first();
        if (!$person) {
            throw new PersonNotFoundException();
        }

        return $person;
    }

    public function create(array $data)
    {
        return Person::create($data);
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data, Person $person): ?Person
    {
        $person->fill($data);
        $person->saveOrFail();

        return $person->fresh();
    }

}
