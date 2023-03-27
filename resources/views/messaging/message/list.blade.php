<?php
/** @var \App\Models\User $otherUser */

/** @var \App\Models\Message $message */

/** @var \Illuminate\Pagination\LengthAwarePaginator $messages */

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
                <div class="container mx-auto shadow-lg rounded-lg">
                    <!-- headaer -->
                    <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
                        <div class="font-semibold text-2xl">{{$otherUser->getName()}}</div>
                        <img class="w-12 h-12 rounded-full" src="{{$otherUser->getProfilePhotoUrl()}}">

                    </div>
                    <!-- end header -->
                    <!-- Chatting -->
                    <div class="flex flex-row justify-between bg-white">
                        <!-- message -->
                        <div class="w-full px-5 flex flex-col justify-between">
                            <div class="mt-5">
                                {{$messages->links()}}
                            </div>

                            <div class="flex flex-col mt-5">
                                @foreach($messages->reverse() as $message)
                                    @if ($message->isMyMessage())
                                        <div class="flex justify-end mb-4">
                                            <div
                                                class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                                {{$message->getContent()}}
                                            </div>

                                        </div>
                                    @else
                                        <div class="flex justify-start mb-4">
                                            <div
                                                class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                                {{$message->getContent()}}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div
                                +>
                                {{$messages->links()}}
                            </div>
                            <div class="py-5">
                                <form method="POST" action="{{route('messaging.message.send')}}">
                                    @csrf
                                    <input type="hidden" name="conversation_id" value="{{$conversationId}}">
                                    <button type="submit"
                                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        {{__('Send')}}
                                    </button>
                                    <input
                                        required
                                        name="message_content"
                                        class="w-full bg-gray-300 py-5 px-3 rounded-xl"
                                        type="text"
                                        placeholder="{{__('type your message here...')}}"
                                    />
                                </form>

                            </div>
                        </div>
                        <!-- end message -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            //jump to bottom of page
            window.scrollTo(0, document.body.scrollHeight);
        </script>
    @endpush
</x-app-layout>



