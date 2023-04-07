<?php

/** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $rides */

/** @var \App\Models\Ride $ride */

?>
<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($rides as $ride)
            <li class="pb-3 pt-3 sm:pb-4 @if($ride->isActiveRide()) bg-blue-50 dark:bg-gray-600 @endif">
                @if($ride->isActiveRide())
                    <div class="text-center font-bold text-xl mb-3 dark:text-white">{{__('Active ride')}}</div>
                @endif
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
                            {{__('Route')}}: {{$ride->fromPlace->getName()}} -> {{$ride->toPlace->getName()}}
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Departure time')}}: {{$ride->getTimeFormatted()}}
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Number of seats')}}: {{$ride->getNumberOfSeats()}}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {!! $ride->getDescriptionFormatted() !!}
                        </p>

                        @if($ride->isOwner() && $ride->isActiveRide())
                            <div class="flex flex-col">
                                @if ($ride->pendingRideRequests->count())
                                    <div class="p-1">
                                        <div
                                            class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                                            role="alert">
                                            {{__('You have x pending requests', ['number' => $ride->pendingRideRequests->count()])}}
                                        </div>
                                    </div>
                                @endif
                                <div class="p-1">
                                    <a
                                        href="{{single_ride_requests_url($ride->getId())}}"
                                        class="w-full block px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        {{__('Requests')}}
                                    </a>
                                </div>
                                <div class="p-1">
                                    @include('ride.my-rides.components.delete-form')
                                </div>
                            </div>
                        @endif
                        @if(!$ride->isOwner())
                            <div class="p-1">
                                <span
                                    class="w-full text-center p-1 status-text status-{{$ride->rideRequestForAuthUser->getStatus()}}">
                               {{__('Ride request status')}}: {{__($ride->rideRequestForAuthUser->getStatus())}}
                               </span>
                            </div>
                            @if($ride->rideRequestForAuthUser->isAccepted())
                                <div class="p-1">
                                    <a
                                        href="{{single_ride_requests_url($ride->getId())}}"
                                        class="w-full block px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        {{__('Requests')}}
                                    </a>
                                </div>
                            @endif
                        @endif
                        @if($ride->canLeaveFeedback())
                            <div class="p-1">
                                <a
                                    href="{{rating_url($ride->getId())}}"
                                    class="w-full block px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    {{__('Leave rating')}}
                                </a>
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

    {{$rides->withQueryString()->links()}}
</div>
