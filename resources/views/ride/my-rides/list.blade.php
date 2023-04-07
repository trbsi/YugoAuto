<?php
/** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $rides */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My rides') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @if($rides !== null && $rides->isNotEmpty())
                    @include('ride.my-rides.components.list_result')
                @else
                    <h1 class="text-4xl text-center p-6 dark:text-white">{{__('No rides')}}</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
