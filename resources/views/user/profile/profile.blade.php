<?php
/** @var \App\Models\User $user */

?>
<x-app-layout>
    <div
        class="dark:bg-gray-800 dark:text-white bg-gray-200 font-sans h-screen w-full flex flex-row justify-center items-center">
        <div class="dark:bg-gray-700 card w-96 mx-auto bg-white  shadow-xl hover:shadow">
            <img class="w-32 h-32 mx-auto object-cover rounded-full border-8 border-white"
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
                @include('user.profile.components.rating', [
                    'rating' => $user->profile->getRating()
                ])
                <div class="w-0 border border-gray-300"></div>
                <div class="w-1/2 text-center">
                    <b>{{__('Number of ratings')}}:</b> {{$user->profile->getRatingCount()}}
                </div>
            </div>

            <hr>
            <div class="flex flex-col">
                <div class="flex flex-1 justify-center px-4 pt-4 pb-3">
                    <span class="italic text-sm text-center">
                        {{__('Last minute cancellation explanation')}}
                    </span>
                </div>
                <div class="flex flex-1 px-4 pb-4">
                    <div class="w-1/2 text-center">
                        <b>{{__('Last minute cancelled rides percentage')}}:</b>
                        <br>
                        {{$user->profile->getLastMinuteCancelledRidesPercentage()}}%
                    </div>
                    <div class="w-0 border border-gray-300"></div>
                    <div class="w-1/2 text-center">
                        <b>{{__('Last minute cancelled rides count')}}:</b>
                        <br>
                        {{$user->profile->getLastMinuteCancelledRidesCount()}}
                    </div>
                </div>
            </div>

            <hr>
            <div class="flex p-4">
                <div class="w-full text-center">
                    <b>{{__('Phone')}}:</b>
                    <x-phone-number :user="$user" :forceShow="false"></x-phone-number>
                </div>
            </div>

            @if ($user->driverProfile)
                <hr>
                <div class="flex p-4">
                    <div class="w-1/2 text-center">
                        <b>{{__('Car name')}}:</b>
                        <br>
                        {{$user->driverProfile->getCarName()}}
                    </div>
                    <div class="w-0 border border-gray-300"></div>
                    <div class="w-1/2 text-center">
                        @include('driver-profiles.components.smoking-animals', [
                            'driverProfile' => $user->driverProfile,
                            'shorthand' => true
                        ])
                    </div>
                </div>
            @endif

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
</x-app-layout>
