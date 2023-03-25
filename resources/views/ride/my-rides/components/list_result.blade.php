<?php

use App\Source\RideRequest\Enum\RideRequestEnum;

/** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $rides */

/** @var \App\Models\Ride $ride */

?>
<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($rides as $ride)
            <li class="pb-3 pt-3 sm:pb-4 @if($ride->isActiveRide()) bg-blue-50 @endif">
                @if($ride->isActiveRide())
                    <div class="text-center font-bold text-xl mb-3">{{__('Active ride')}}</div>
                @endif
                <div class="flex items-center space-x-4">

                    <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="{{$ride->user->getProfilePhotoUrl()}}"
                             alt="Neil image">
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{$ride->user->getName()}}
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Departure time')}} {{$ride->getTimeFormatted()}}
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Number of seats')}} {{$ride->getNumberOfSeats()}}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{$ride->getDescription()}}
                        </p>

                        @if($authUserId === $ride->getUserId())
                            <hr>
                            @if ($ride->pendingRideRequests->count())
                                <div
                                    class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                                    role="alert">
                                    {{__('You have x pending requests', ['number' => $ride->pendingRideRequests->count()])}}
                                </div>
                            @endif


                            <div class="flex flex-row mt-2">
                                <div class="mr-2">
                                    <a
                                        href="{{route('ride-request.my-requests', ['rideId' => $ride->getId()])}}"
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        {{__('Requests')}}
                                    </a>
                                </div>
                                @include('ride.my-rides.components.delete-form')
                            </div>
                        @else
                            <span
                                class="p-1 status-{{$ride->rideRequestsForAuthUser->getStatus()}}">
                                    {{__('Ride request status')}}: {{__($ride->rideRequestsForAuthUser->getStatus())}}
                                    </span>
                        @endif
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        {{$ride->getPrice()}} {{$ride->getCurrency()}}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    {{$rides->withQueryString()->links()}}
</div>
