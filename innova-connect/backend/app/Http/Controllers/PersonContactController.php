<?php

namespace App\Http\Controllers;

use App\Exceptions\PersonContactNotFoundException;
use App\Exceptions\PersonNotFoundException;
use App\Http\Resources\PersonContactResource;
use App\Models\Person;
use App\Models\PersonContact;
use App\Services\PersonContactService;
use Illuminate\Http\Request;

/**
 * Class PersonContactController
 * @package App\Http\Controllers
 */
class PersonContactController extends Controller
{
    /**
     * @var PersonContactService
     */
    private $contactPersonService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PersonContactService $contactPersonService)
    {
        $this->contactPersonService = $contactPersonService;
    }

    /**
     * @throws PersonContactNotFoundException
     */
    public function show($id)
    {
        return new PersonContactResource($this->contactPersonService->show($id));
    }

    /**
     * @param Request $request
     * @return PersonContactResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'contact_type' => 'required|integer',
            'contact' => 'required|string',
            'person_id' => 'required|integer'
        ]);

        $person = Person::where('id', $request->input('person_id'))->first();
        if (!$person) {
            throw new PersonNotFoundException();
        }

        return new PersonContactResource($this->contactPersonService->create($request->all()));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'contact_type' => 'required|integer',
            'contact' => 'required|string',
            'person_id' => 'required|integer'
        ]);

        $person = Person::where('id', $request->input('person_id'))->first();
        if (!$person) {
            throw new PersonNotFoundException();
        }

        $contact = PersonContact::where([
            ['id', $id],
            ['person_id', $request->input('person_id')]
        ])->first();
        if (!$contact) {
            throw new PersonContactNotFoundException();
        }

        return new PersonContactResource($this->contactPersonService->update($request->all(), $contact));
    }

    public function destroy($id)
    {
        $contact = PersonContact::where('id', $id)->first();
        if (!$contact) {
            throw new PersonContactNotFoundException();
        }

        $contact->delete();

        return response()->json(['message' => 'Deleted successful']);
    }
}
