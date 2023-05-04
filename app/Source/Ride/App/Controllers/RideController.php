<?php

declare(strict_types=1);

namespace App\Source\Ride\App\Controllers;

use App\Enum\TimeEnum;
use App\Http\Controllers\Controller;
use App\Source\Helper\Trait\RequiredParamsCheckTrait;
use App\Source\Place\Domain\SearchPlaces\SearchPlacesLogic;
use App\Source\Ride\App\Requests\CreateRideRequest;
use App\Source\Ride\App\Requests\SearchRidesRequest;
use App\Source\Ride\Domain\CreateRide\CreateRideLogic;
use App\Source\Ride\Domain\DeleteRide\DeleteRideLogic;
use App\Source\Ride\Domain\MyRides\MyRidesLogic;
use App\Source\Ride\Domain\SearchRides\SearchRidesLogic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RideController extends Controller
{
    use RequiredParamsCheckTrait;

    public function search(
        SearchRidesRequest $request,
        SearchRidesLogic $logic,
        SearchPlacesLogic $placesBusinessLogic
    ) {
        try {
            $requiredParams = ['from_place_id', 'to_place_id'];
            $fromPlace = $minTime = $maxTime = $isAcceptingPackage = null;
            $toPlaces = new Collection();

            if ($this->hasRequiredParams($requiredParams, $request->all())) {
                $fromPlace = $request->from_place_id;
                $toPlace = $request->to_place_id;
                $minTime = $request->min_time;
                $maxTime = $request->max_time;
                $isAcceptingPackage = $request->is_accepting_package === 'on' ? true : false;
                $filter = $request->filter ?? '';

                $fromPlace = $placesBusinessLogic->getById((int)$fromPlace);
                $toPlaces = $placesBusinessLogic->getByIds(explode(',', $toPlace));

                $rides = $logic->search(
                    fromPlaceId: $fromPlace->getId(),
                    toPlaceIds: $toPlaces->pluck('id')->toArray(),
                    minStartTime: $minTime ? Carbon::createFromFormat(
                        TimeEnum::DATE_FORMAT->value,
                        $minTime
                    ) : $minTime,
                    maxStartTime: $maxTime ? Carbon::createFromFormat(
                        TimeEnum::DATE_FORMAT->value,
                        $maxTime
                    ) : $maxTime,
                    isAcceptingPackage: $isAcceptingPackage,
                    filter: $filter
                );
            } else {
                $rides = $logic->latestRides();
            }

            return view(
                (Auth::guest()) ? 'ride.search.public_list' : 'ride.search.private_list',
                [
                    'rides' => $rides,
                    'fromPlace' => $fromPlace,
                    'toPlaces' => $toPlaces,
                    'minTime' => $minTime,
                    'maxTime' => $maxTime,
                    'isAcceptingPackage' => $isAcceptingPackage
                ]
            );
        } catch (Exception $exception) {
            $request->session()->flash('warning', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function showCreate(
        Request $request,
        SearchPlacesLogic $searchPlacesBusinessLogic
    ) {
        $fromPlaceId = old('from_place_id');
        $toPlaceId = old('to_place_id');
        $toPlace = $fromPlace = null;
        if ($fromPlaceId && $toPlaceId) {
            $fromPlace = $searchPlacesBusinessLogic->getById((int)$fromPlaceId);
            $toPlace = $searchPlacesBusinessLogic->getById((int)$toPlaceId);
        }
        return view(
            'ride.create.create-form',
            [
                'fromPlace' => $fromPlace,
                'toPlace' => $toPlace,
                'driverProfile' => Auth::user()->driverProfile
            ]
        );
    }

    public function save(
        CreateRideRequest $request,
        CreateRideLogic $logic
    ) {
        try {
            $logic->create(
                driverId: Auth::id(),
                fromPlaceId: (int)$request->from_place_id,
                toPlaceId: (int)$request->to_place_id,
                time: $request->time,
                numberOfSeats: (int)$request->number_of_seats,
                price: (int)$request->price,
                description: $request->description,
                isAcceptingPackage: $request->is_accepting_package === 'on' ? true : false,
                car: $request->car
            );
            $request->session()->flash('success', __('Ride is created'));
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            return redirect()->back()->withInput();
        }
        return redirect(route('ride.my-rides'));
    }

    public function myRides(
        MyRidesLogic $logic
    ) {
        $authUserId = Auth::id();
        $rides = $logic->get($authUserId);
        return view(
            'ride.my-rides.list',
            compact('rides')
        );
    }

    public function delete(
        int $id,
        Request $request,
        DeleteRideLogic $logic
    ) {
        try {
            $logic->delete($id, Auth::id());
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }
        return redirect()->back();
    }
}
