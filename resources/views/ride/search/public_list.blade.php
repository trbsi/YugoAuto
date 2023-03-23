<x-guest-layout>
    <div class="text-center ">
        <h2 class="text-4xl mt-10">
            {{ config('app.name') }}

        </h2>

        {{__('Find your ride')}}
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @include('ride.search.search_form')
                @if($rides !== null)
                    @include('ride.search.list_result')
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
