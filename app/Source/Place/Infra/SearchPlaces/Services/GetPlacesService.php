<?php

declare(strict_types=1);

namespace App\Source\Place\Infra\SearchPlaces\Services;

use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;

class GetPlacesService
{
    public function get(string $term): Collection
    {
        return Place::where('name', 'LIKE', $term . '%')->get();
    }

    public function getById(int $id): Place
    {
        return Place::find($id);
    }
}
