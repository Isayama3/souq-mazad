<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'products' => ProductResource::make($this->whenLoaded('Products')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
