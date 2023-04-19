<?php

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/** @var LengthAwarePaginator|Collection $rides */

/** @var \App\Models\Ride $ride */

/** @var \App\Models\Place $fromPlace */

/** @var \App\Models\Place $toPlace */
?>
<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    @if($fromPlace && $toPlace)
        <h2 class="pb-6 text-4xl">{{$fromPlace->getName()}} - {{$toPlace->getName()}}</h2>
    @endif

    @if($rides instanceof Collection)
        <h2 class="pb-6 text-4xl dark:text-white">{{__('Newest rides')}}</h2>
    @endif


    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($rides as $ride)
            <li class="pb-3 pt-3 sm:pb-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <a class="underline" href="{{user_profile_url($ride->driver->getId())}}">
                            <img class="w-8 h-8 rounded-full" src="{{$ride->driver->getProfilePhotoUrl()}}"
                                 alt="Neil image">
                        </a>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            <a class="underline" href="{{user_profile_url($ride->driver->getId())}}">
                                {{$ride->driver->getName()}}
                            </a>
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Route')}}: {{$ride->fromPlace->getName()}} - {{$ride->toPlace->getName()}}
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Departure time')}}: {{$ride->getRideTimeFormatted()}}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {!! $ride->getDescriptionFormatted() !!}
                        </p>
                        @if($ride->isFilled())
                            <div
                                class="w-full text-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                role="alert">
                                {{__('Ride is filled')}}
                            </div>
                        @elseif($ride->isMyRide())
                            <b>{{__('Your ride')}}</b>
                        @elseif(!$ride->rideRequestForAuthUser)
                            @include('ride.search.components.request-ride-form')
                        @else
                            <p class="mt-2">
                                <span
                                    class="w-full text-center p-1 status-text status-{{$ride->rideRequestForAuthUser->getStatus()}}">
                                {{__('Ride request status')}}: {{__($ride->rideRequestForAuthUser->getStatus())}}
                                </span>
                            </p>
                        @endif
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        {{$ride->getPrice()}} {{$ride->getCurrency()}}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    @if($rides instanceof LengthAwarePaginator)
        {{$rides->withQueryString()->links()}}
    @endif
</div>
