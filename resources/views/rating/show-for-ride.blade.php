<?php
/** @var \App\Models\Rating $rating */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leave rating') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-1 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <div class="p-6">
                        <h1 class="pb-6 text-4xl">{{$ride->fromPlace->getName()}} - {{$ride->toPlace->getName()}}</h1>
                        <div>
                            <b>{{__('Departure time')}}:</b> {{$ride->getRideTimeFormatted()}}
                        </div>
                    </div>

                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($ratings as $rating)
                            <li class="py-3 sm:py-4">
                                <div class="flex flex-col">
                                    <div class="flex">
                                        <div class="w-1/2 p-4">
                                            @include('rating.components.rating-between-users', [
                                               'user' => $rating->driver
                                           ])
                                        </div>
                                        <div class="w-1/2 p-4">
                                            @include('rating.components.rating-between-users', [
                                               'user' => $rating->passenger
                                           ])
                                        </div>
                                    </div>
                                    <div class="flex">
                                        {{-- DRIVER --}}
                                        <div class="w-1/2 p-4">
                                            @if($rating->isDriverRated())
                                                @include('rating.components.stars-rating', [
                                                    'rating' => $rating->getDriverRating(),
                                                    'comment' => $rating->getDriverComment()
                                                ])
                                            @elseif($rating->isCurrentUserDriver() && !$rating->isDriverRated())
                                                {{__('You are not rated')}}
                                            @elseif($rating->isCurrentUserPassenger())
                                                @include('rating.components.stars-form', [
                                                        'ratingId' => $rating->getId(),
                                                        'userToBeRatedId' => $rating->getDriverId(),
                                                        'comment' => $rating->getDriverComment(),
                                                ])
                                            @endif
                                        </div>
                                        {{-- PASSENGER --}}
                                        <div class="w-1/2 p-4">
                                            @if($rating->isPassengerRated())
                                                @include('rating.components.stars-rating', [
                                                    'rating' => $rating->getPassengerRating(),
                                                    'comment' => $rating->getPassengerComment()
                                                ])
                                            @elseif($rating->isCurrentUserPassenger() && !$rating->isPassengerRated())
                                                {{__('You are not rated')}}
                                            @elseif($rating->isCurrentUserDriver())
                                                @include('rating.components.stars-form', [
                                                    'ratingId' => $rating->getId(),
                                                    'userToBeRatedId' => $rating->getPassengerId(),
                                                    'comment' => $rating->getPassengerComment(),
                                                ])
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
