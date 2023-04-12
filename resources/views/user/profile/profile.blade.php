<?php
/** @var \App\Models\User $user */

?>
<x-guest-layout>

    <div class="dark:bg-gray-800 bg-gray-200 font-sans h-screen w-full flex flex-row justify-center items-center">
        <div class="dark:bg-gray-700 card w-96 mx-auto bg-white  shadow-xl hover:shadow">
            <img class="w-32 h-32 mx-auto object-cover rounded-full -mt-20 border-8 border-white"
                 src="{{$user->getProfilePhotoUrl()}}" alt="">
            <div class="text-center mt-2 text-3xl font-medium">{{$user->getName()}}</div>

            <div class="m-3">
                <a href="{{route('messaging.conversation.create-form', ['userId' => $user->getId()])}}"
                   class="text-center block w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    {{__('Send a message')}}
                </a>
            </div>

            <hr class="mt-8">
            <div class="flex p-4">
                @if ($user->getPhoneNumber())
                    <div class="w-1/2 text-center">
                        @include('user.profile.components.rating', [
                        'rating' => $user->profile->getRating()
                    ])
                    </div>
                    <div class="w-0 border border-gray-300"></div>
                    <div class="w-1/2 text-center">
                        {{__('Phone')}} <a class="underline"
                                           href="tel:{{$user->getPhoneNumber()}}">{{$user->getPhoneNumber()}}</a>
                    </div>
                @else
                    @include('user.profile.components.rating', [
                        'rating' => $user->profile->getRating()
                    ])
                    <div class="w-0 border border-gray-300"></div>
                    <div class="w-1/2 text-center">
                        {{__('Number of ratings')}}: {{$user->profile->getRatingCount()}}
                    </div>
                @endif
            </div>

            <hr>
            <div class="flex p-4">
                <div class="w-1/2 text-center">
                    <a id="showReportForm" href="javascript:;"
                       class="w-full block text-center underline">
                        {{__('Report user')}}
                    </a>
                </div>
                <div class="w-0 border border-gray-300"></div>
                <div class="w-1/2 text-center">
                    <a href="{{rating_for_user_url($user->getId())}}"
                       class="w-full block text-center underline">
                        {{__('View ratings')}}
                    </a>
                </div>
            </div>

            @include('user.profile.components.report-form')
        </div>
    </div>
</x-guest-layout>
