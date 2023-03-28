<?php
/** @var \App\Models\Conversation $conversation */

?>
<ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
    @foreach($conversations as $conversation)
        <li class="py-3 sm:py-4 @if(!$conversation->isReadByCurrentUser()) bg-blue-50 @endif">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <a href="{{conversation_url($conversation->getId())}}">
                        <img class="w-8 h-8 rounded-full"
                             src="{{$conversation->getOtherUser()->getProfilePhotoUrl()}}"
                             alt="Neil image">
                    </a>
                </div>
                <div class="flex-1 min-w-0">
                    <a class="underline"
                       href="{{conversation_url($conversation->getId())}}">
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
