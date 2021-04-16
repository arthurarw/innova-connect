<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class PersonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'firstname' => (string)$this->firstname,
            'lastname' => (string)$this->lastname,
            'contacts' => $this->contacts,
            'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at))
        ];
    }
}
