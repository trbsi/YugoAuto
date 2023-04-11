<?php
/** @var \App\Models\Rating $rating */

/** @var \App\Models\User $user */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ratings for user', ['name' => $user->getName()]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-1 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700 p-5">
                        @foreach($ratings as $rating)
                            <li class="py-3 sm:py-4">
                                <div class="flex flex-wrap">
                                    <div class="w-1/6">
                                        <a href="{{conversation_url($rating->getId())}}">
                                            <img class="w-8 h-8 rounded-full"
                                                 src="{{$rating->getOtherUser()->getProfilePhotoUrl()}}"
                                                 alt="Neil image">
                                        </a>
                                    </div>
                                    <div class="w-5/6">
                                        <a class="underline text-sm font-medium text-gray-900 truncate dark:text-white"
                                           href="{{conversation_url($rating->getId())}}">
                                            {{$rating->getOtherUser()->getName()}}
                                        </a>
                                        <span class="text-xs pl-3">{{$rating->getUpdatedAtFormatted()}}</span>
                                    </div>
                                    <div class="w-1/6">
                                    </div>
                                    <div class="w-5/6">
                                        @include('rating.components.stars-rating', [
                                            'rating' => $rating->getRatingForUser($user->getId()),
                                            'comment' => $rating->getCommentForUser($user->getId())
                                        ])
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{$ratings->render()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
