<?php

use App\Source\RideRequest\Enum\RideRequestEnum;

/** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $requests */

/** @var \App\Models\RideRequest $request */
/** @var \App\Models\Ride $ride */
?>
<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <h1 class="pb-6 text-4xl dark:text-white">{{$ride->fromPlace->getName()}} - {{$ride->toPlace->getName()}}</h1>
    <h2 class="pb-6 text-xl dark:text-white">{{__('Departure time')}} {{$ride->getTimeFormatted()}}</h2>

    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($requests as $request)
            @if(!$request->ride->isMyRide() && !$request->isAccepted())
                @continue
            @endif

            <li class="pb-3 pt-3 sm:pb-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <a class="underline" href="{{user_profile_url($request->passenger->getId())}}">
                            <img class="w-8 h-8 rounded-full" src="{{$request->passenger->getProfilePhotoUrl()}}"
                                 alt="Neil image">
                        </a>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            <a class="underline" href="{{user_profile_url($request->passenger->getId())}}">
                                {{$request->passenger->getName()}}
                            </a>
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Rating')}}: {{$request->passenger->profile->getRating()}}
                        </p>
                        <p class="mt-2">
                                <span
                                    class="w-full text-center p-1 status-text status-{{$request->getStatus()}}">
                                {{__('Ride request status')}}: {{__($request->getStatus())}}
                                </span>
                        </p>
                        @if($request->canBeAcceptedOrRejected())
                            <div class="mt-3">
                                <div class="mb-3">
                                    @include('ride-requests.my-requests.components.accept-form')
                                </div>
                                <div>
                                    @include('ride-requests.my-requests.components.reject-form')
                                </div>
                            </div>
                        @endif

                        @if($request->canBeCancelled())
                            <div class="mt-3">
                                @include('ride-requests.my-requests.components.cancel-form')
                            </div>
                        @endif
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        {{$ride->getPrice()}} {{$ride->getCurrency()}}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    {{$requests->withQueryString()->links()}}
</div>
