<?php


namespace App\Exceptions;

use Exception;

class PersonContactNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Person Contact not found.';

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 404);
    }
}
