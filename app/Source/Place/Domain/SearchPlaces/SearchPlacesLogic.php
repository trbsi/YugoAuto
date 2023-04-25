<?php

declare(strict_types=1);

namespace App\Source\Place\Domain\SearchPlaces;

use App\Models\Place;
use App\Source\Place\Infra\SearchPlaces\Services\GetPlacesService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SearchPlacesLogic
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
        try {
            return $this->getPlacesService->getById($id);
        } catch (Exception $exception) {
            throw new Exception(__('Chosen city does not exist'));
        }
    }

    public function getByIds(array $ids): Collection
    {
        try {
            return $this->getPlacesService->getByIds($ids);
        } catch (Exception $exception) {
            throw new Exception(__('Chosen city does not exist'));
        }
    }
}
