<?php
/** @var \App\Models\User $user */

?>

<div class="flex items-center space-x-4">
    <div class="flex-shrink-0">
        <a href="{{user_profile_url($user->getId())}}">
            <img class="w-8 h-8 rounded-full"
                 src="{{$user->getProfilePhotoUrl()}}">
        </a>
    </div>
    <div class="flex-1 min-w-0">
        <a class="underline"
           href="{{user_profile_url($user->getId())}}">
            <p class="text-sm font-medium text-gray-900 dark:text-white">
                {{$user->getName()}}
            </p>
        </a>
    </div>
</div>
