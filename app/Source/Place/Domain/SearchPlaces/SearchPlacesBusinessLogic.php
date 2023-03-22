<?php

declare(strict_types=1);

namespace App\Source\Place\Domain\SearchPlaces;

use App\Models\Place;
use App\Source\Place\Infra\SearchPlaces\Services\GetPlacesService;
use Illuminate\Database\Eloquent\Collection;

class SearchPlacesBusinessLogic
{
    private GetPlacesService $getPlacesService;

    public function __construct(
        GetPlacesService $getPlacesService
    ) {
        $this->getPlacesService = $getPlacesService;
    }

    public function get(string $term): Collection
    {
        return $this->getPlacesService->get($term);
    }

    public function getById(int $id): Place
    {
        return $this->getPlacesService->getById($id);
    }
}
