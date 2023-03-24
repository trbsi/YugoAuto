<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search ride') }}
        </h2>
    </x-slot>

   @include('ride.search.components.list')
</x-app-layout>
