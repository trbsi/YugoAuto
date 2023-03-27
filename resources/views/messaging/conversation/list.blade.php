<?php
/** @var \App\Models\Conversation $conversation */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- component -->
                <div
                    class="p-4 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flow-root">
                        @if ($conversations->isEmpty())
                            <h1 class="pb-6 text-4xl text-center">{{__('No conversations')}}</h1>
                        @else
                            @include('messaging.conversation.components.list_result')
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
