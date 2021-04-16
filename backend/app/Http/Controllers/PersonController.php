<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonResource;
use App\Services\PersonService;
use Illuminate\Http\Request;

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

    public function store(Request $request, $id)
    {

    }
}
