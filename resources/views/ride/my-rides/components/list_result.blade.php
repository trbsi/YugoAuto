<?php

/** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $rides */

/** @var \App\Models\Ride $ride */

?>
<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($rides as $ride)
            <li class="pb-3 pt-3 sm:pb-4 @if(!$ride->isActiveRide()) non-active-ride @endif">
                @if($ride->isActiveRide())
                    <div class="text-center font-bold text-xl mb-3 dark:text-white">{{__('Active ride')}}</div>
                @else
                    <div
                        class="make-transparent text-center font-bold text-xl mb-3 dark:text-white">{{__('Non active ride')}}</div>
                @endif
                <div class="flex items-center space-x-4">

                    <div class="flex-shrink-0 make-transparent">
                        <a class="underline" href="{{user_profile_url($ride->driver->getId())}}">
                            <img class="w-8 h-8 rounded-full" src="{{$ride->driver->getProfilePhotoUrl()}}">
                        </a>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="make-transparent text-sm font-medium text-gray-900 truncate dark:text-white">
                            <a class="underline" href="{{user_profile_url($ride->driver->getId())}}">
                                {{$ride->driver->getName()}}
                            </a>
                        </p>
                        <p class="make-transparent text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Route')}}: {{$ride->fromPlace->getName()}} -> {{$ride->toPlace->getName()}}
                        </p>
                        <p class="make-transparent text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Departure time')}}: {{$ride->getRideTimeFormatted()}}
                        </p>
                        <p class="make-transparent text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{__('Number of seats')}}: {{$ride->getNumberOfSeats()}}
                        </p>
                        <p class="make-transparent text-sm text-gray-500 dark:text-gray-400">
                            {!! $ride->getDescriptionFormatted() !!}
                        </p>

                        @if($ride->isOwner() && $ride->isActiveRide())
                            <div class="flex flex-col">
                                @if ($ride->pendingRideRequests->count())
                                    <div class="p-1">
                                        <x-alert
                                            role="warning"
                                            :content="__('You have x pending requests', ['number' => $ride->pendingRideRequests->count()])"
                                        ></x-alert>
                                    </div>
                                @endif
                                <div class="p-1">
                                    <x-anchor
                                        role="blue"
                                        :url="single_ride_requests_url($ride->getId())"
                                        class="text-sm p-1"
                                        :text="__('Requests/Details')"
                                    ></x-anchor>
                                </div>
                                <div class="p-1">
                                    <x-anchor
                                        role="blue"
                                        :url="update_ride($ride->getId())"
                                        class="text-sm p-1"
                                        :text="__('Edit ride')"
                                    ></x-anchor>
                                </div>
                                <div class="p-1">
                                    @include('ride.my-rides.components.delete-form')
                                </div>
                            </div>
                        @endif

                        @if(!$ride->isOwner())
                            <div class="make-transparent p-1">
                                <x-ride-status :status="$ride->rideRequestForAuthUser->getStatus()"></x-ride-status>
                            </div>
                            @if($ride->isActiveRide())
                                @if($ride->rideRequestForAuthUser->isAccepted())
                                    <div class="p-1">
                                        <x-anchor
                                            role="blue"
                                            :url="single_ride_requests_url($ride->getId())"
                                            class="text-sm p-1"
                                            :text="__('Requests/Details')"
                                        ></x-anchor>
                                    </div>
                                @endif

                                @if($ride->rideRequestForAuthUser->isPending())
                                    <div class="p-1">
                                        @include('ride-requests.my-requests.components.cancel-form',
                                        [
                                            'request' => $ride->rideRequestForAuthUser
                                        ])
                                    </div>
                                @endif
                            @endif
                        @endif
                        @if($ride->canLeaveRating())
                            <div class="p-1">
                                <x-anchor
                                    role="blue"
                                    :url="rating_for_ride_url($ride->getId())"
                                    class="text-sm p-1"
                                    :text="__('Leave rating')"
                                ></x-anchor>
                            </div>
                        @endif
                    </div>
                    <div
                        class="make-transparent inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        {{$ride->getPrice()}} {{$ride->getCurrency()}}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    {{$rides->withQueryString()->links()}}
</div>
