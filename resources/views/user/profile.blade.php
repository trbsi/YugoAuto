<?php
/** @var \App\Models\User $user */

?>
<x-guest-layout>

    <div class="bg-gray-200 font-sans h-screen w-full flex flex-row justify-center items-center">
        <div class="card w-96 mx-auto bg-white  shadow-xl hover:shadow">
            <img class="w-32 mx-auto rounded-full -mt-20 border-8 border-white"
                 src="{{$user->getProfilePhotoUrl()}}" alt="">
            <div class="text-center mt-2 text-3xl font-medium">{{$user->getName()}}</div>
            <?php
            /*
                       <div class=" text-center mt-2 font-light text-sm">@devpenzil
                       </div>
                       <div class="text-center font-normal text-lg">Kerala</div>
                       <div class="px-6 text-center mt-2 font-light text-sm">
                           <p>
                               Front end Developer, avid reader. Love to take a long walk, swim
                           </p>
                       </div>
            */ ?>
            <hr class="mt-8">
            <div class="flex p-4">
                <div class="w-1/2 text-center">
                    {{__('Rating')}} <span class="font-bold">{{$user->profile->getRating()}}</span>
                </div>
                <div class="w-0 border border-gray-300">

                </div>
                <div class="w-1/2 text-center">
                    {{__('Phone')}} <span class="font-bold">
                        @if ($user->getPhoneNumber())
                            <a class="underline" href="tel:{{$user->getPhoneNumber()}}">{{$user->getPhoneNumber()}}</a>
                        @else
                            {{__('No phone')}}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
