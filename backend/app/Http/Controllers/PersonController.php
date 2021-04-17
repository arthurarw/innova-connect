<?php

namespace App\Http\Controllers;

use App\Exceptions\PersonNotFoundException;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonController extends Controller
{
    private $personService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function index()
    {
        return PersonResource::collection($this->personService->listAll());
    }

    public function show($id)
    {
        return new PersonResource($this->personService->show($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'person_id' => 'required'
        ]);

        $person = Person::where('id', $id)->first();
        if (!$person) {
            throw new PersonNotFoundException();
        }

        return new PersonResource($this->personService->update($request->all(), $person));
    }
}
