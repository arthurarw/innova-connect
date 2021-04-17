<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonContactResource;
use App\Services\PersonContactService;
use Illuminate\Http\Request;

class PersonContactController extends Controller
{
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'contact_type' => 'required',
            'contact' => 'required|string',
            'person_id' => 'required'
        ]);

        return new PersonContactResource($this->contactPersonService->create($request->all()));
    }
}
