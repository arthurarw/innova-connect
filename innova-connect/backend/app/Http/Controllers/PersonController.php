<?php

namespace App\Http\Controllers;

use App\Exceptions\PersonNotFoundException;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PersonController
 * @package App\Http\Controllers
 */
class PersonController extends Controller
{
    /**
     * @var PersonService
     */
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

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PersonResource::collection($this->personService->listAll());
    }

    /**
     * @param $id
     * @return PersonResource
     * @throws PersonNotFoundException
     */
    public function show($id)
    {
        return new PersonResource($this->personService->show($id));
    }

    /**
     * @param Request $request
     * @return PersonResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);

        return new PersonResource($this->personService->create($request->all()));
    }

    /**
     * @param Request $request
     * @param $id
     * @return PersonResource
     * @throws PersonNotFoundException
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string'
        ]);

        $person = Person::where('id', $id)->first();
        if (!$person) {
            throw new PersonNotFoundException();
        }

        return new PersonResource($this->personService->update($request->all(), $person));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws PersonNotFoundException
     */
    public function destroy($id)
    {
        $person = Person::where('id', $id)->first();
        if (!$person) {
            throw new PersonNotFoundException();
        }

        $person->contacts()->delete();
        $person->delete();

        return response()->json(['message' => 'Deleted successful']);
    }
}
