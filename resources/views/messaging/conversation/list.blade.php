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
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($conversations as $conversation)
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <a href="{{conversation_url($conversation->getId())}}">
                                                <img class="w-8 h-8 rounded-full"
                                                     src="{{$conversation->getOtherUser()->getProfilePhotoUrl()}}"
                                                     alt="Neil image">
                                            </a>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <a class="underline" href="{{conversation_url($conversation->getId())}}">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{$conversation->getOtherUser()->getName()}}
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{$conversations->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
