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
            'ads_zipcode' => (string) $this->ads_zipcode,
            'ads_street' => (string) $this->ads_street,
            'ads_number' => (string) $this->ads_number,
            'ads_neighborhood' => (string) $this->ads_neighborhood,
            'ads_complement' => (string) $this->ads_complement,
            'ads_city' => (string) $this->ads_city,
            'ads_state' => (string) $this->ads_state,
            'address' => $this->getFullAddress(),
            'contacts' => PersonContactResource::collection($this->contacts),
            'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at))
        ];
    }
}
