<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'article' => $this->resource->article,
            'name' => $this->resource->name,
            'status' => $this->resource->status,
            'status_name' => $this->resource->status_name,
            'data' => $this->resource->data
        ];
    }
}
