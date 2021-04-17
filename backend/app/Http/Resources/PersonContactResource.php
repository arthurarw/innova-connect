<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class PersonContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'contact_type' => (string)$this->contact_type,
            'contact' => (string)$this->contact,
            'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at))
        ];
    }
}
