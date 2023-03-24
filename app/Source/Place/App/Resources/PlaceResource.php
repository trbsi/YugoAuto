<?php

namespace App\Source\Place\App\Resources;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Place $place */
        $place = $this;
        return [
            'value' => $place->getId(),
            'label' => $place->getName()
        ];
    }
}
