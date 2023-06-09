<?php
/** @var \App\Models\Ride $ride */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My requests') }}
        </h2>
    </x-slot>

    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">

                @include('ride-requests.my-requests.components.ride-info')

                @if($requests !== null && $requests->isNotEmpty())
                    @include('ride-requests.my-requests.components.list_result')
                @else
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <h1 class="text-4xl text-center p-6 dark:text-white">{{__('No requests')}}</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
