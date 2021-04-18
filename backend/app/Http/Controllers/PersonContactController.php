<?php

namespace App\Http\Controllers;

use App\Exceptions\PersonContactNotFoundException;
use App\Http\Resources\PersonContactResource;
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
     * @param Request $request
     * @return PersonContactResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'contact_type' => 'required',
            'contact' => 'required|string',
            'person_id' => 'required'
        ]);

        return new PersonContactResource($this->contactPersonService->create($request->all()));
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
