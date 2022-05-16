<?php

namespace App\Http\Resources\Advert;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AdvertSingleResource extends AdvertBasicResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request) + [
            'editableForAuthUser' => $this->author_id === (auth('sanctum')->user()->id ?? null),
            'description' => $this->description,
            'images' => count($this->images) > 0 ? $this->images()->pluck('path')->toArray() : []
        ];
    }
}
