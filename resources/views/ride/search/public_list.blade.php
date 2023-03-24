<x-guest-layout>
    <div class="text-center ">
        <h2 class="text-4xl mt-10">
            {{ config('app.name') }}

        </h2>

        {{__('Find your ride')}}
    </div>

    @include('ride.search.components.list')
</x-guest-layout>
