<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'products',
            'id' => $this->id,
            'atrtributes' => [
                'name' => $this->name,
                'price' => $this->price
            ],
            'links' => [
                'self' => 'http://localhost:8000/api/products/'.$this->id
            ]
        ];
    }
}
