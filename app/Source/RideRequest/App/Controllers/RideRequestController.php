<?php

namespace App\Source\RideRequest\App\Controllers;

use App\Source\RideRequest\App\Requests\AcceptOrRejectRideRequest;
use App\Source\RideRequest\App\Requests\CancelRideRequest;
use App\Source\RideRequest\Domain\AcceptOrReject\AcceptOrRejectBusinessLogic;
use App\Source\RideRequest\Domain\CancelRide\CancelRideBusinessLogic;
use App\Source\RideRequest\Domain\RequestRide\RequestRideBusinessLogic;
use App\Source\RideRequest\Domain\RideRequests\RideRequestsBusinessLogic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RideRequestController
{
    public function myRequests(
        int $rideId,
        Request $request,
        RideRequestsBusinessLogic $businessLogic
    ) {
        try {
            $requests = $businessLogic->getRequests(Auth::id(), $rideId);
            $ride = $businessLogic->getRide($rideId);
            return view(
                'ride-requests.my-requests.list',
                compact('requests', 'ride')
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
            return redirect()->back();
        }
    }

    public function acceptOrReject(
        AcceptOrRejectRideRequest $request,
        AcceptOrRejectBusinessLogic $businessLogic
    ) {
        try {
            $businessLogic->acceptOrReject(
                Auth::id(),
                (int)$request->ride_id,
                (int)$request->user_id,
                $request->status
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }

    public function sendRequest(
        int $rideId,
        Request $request,
        RequestRideBusinessLogic $businessLogic
    ) {
        try {
            $businessLogic->requestRide(Auth::id(), $rideId);
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }

    public function cancelRequest(
        CancelRideRequest $request,
        CancelRideBusinessLogic $businessLogic
    ) {
        try {
            $businessLogic->cancel(
                Auth::id(),
                $request->passenger_id,
                $request->ride_id
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }


}
