<?php

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            @include('ride.search.components.search_form')
            @if($rides !== null && $rides->isNotEmpty())
                @if($rides instanceof LengthAwarePaginator)
                    @include('ride.search.components.filters')
                @endif
                @include('ride.search.components.list_result')
            @else
                <h1 class="text-4xl text-center p-6 dark:text-white">{{__('No rides')}}</h1>
            @endif
        </div>
    </div>
</div>
