<?php
/** @var \App\Models\User $user */

?>
<x-app-layout>
    <div class="dark:bg-gray-900 bg-gray-100 min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto lg:min-w-[500px]">
            <div
                class="dark:bg-gray-800 dark:text-white text-gray-700 relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5">
                        <div
                            class="h-14 w-14 bg-indigo-200 rounded-full flex flex-shrink-0 justify-center items-center text-indigo-500 text-2xl font-mono">
                            <img class="w-14 h-14 mx-auto object-cover rounded-full border-white"
                                 src="{{$user->getProfilePhotoUrl()}}" alt="">
                        </div>
                        <div class="block pl-2 font-semibold text-xl self-start dark:text-white">
                            <h2 class="leading-relaxed">{{__('Compose New Message')}}</h2>

                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 sm:text-lg sm:leading-7">
                            <form action="{{ route('messaging.conversation.create') }}" method="POST"
                                  id="send_message_form">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{$user->getId()}}">
                                <div class="mb-4">
                                    <label class="block font-bold mb-2" for="recipient_id">
                                        {{__('Receiver')}}: {{$user->getName()}}
                                    </label>
                                    @error('recipient_id')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block font-bold mb-2" for="message_content">
                                        {{__('Message')}}:
                                    </label>
                                    <textarea required name="message_content" id="message_content" rows="5"
                                              class="form-textarea w-full"></textarea>
                                    @error('content')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{__('Send')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            /*
            document.querySelector('#message_content').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    $('#send_message_form').submit();
                }
            });
            */
        </script>
    @endpush
</x-app-layout>
