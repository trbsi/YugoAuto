<div
    class="fixed bottom-0 z-50 w-full -translate-x-1/2 bg-white border-t border-gray-200 left-1/2 dark:bg-gray-700 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
        <a href="{{route('home')}}" data-tooltip-target="tooltip-home" type="button"
           class="inline-flex flex-col items-center justify-center p-4 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">{{__('Search')}}</span>
        </a>
        <a href="{{route('messaging.conversation.list')}}" data-tooltip-target="tooltip-bookmark" type="button"
           class="inline-flex flex-col items-center justify-center p-4 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i class="fa-solid fa-message relative">
                @if($unreadMessages)
                    <div
                        class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-3 -right-3 dark:border-gray-900">
                        *
                    </div>
                @endif
            </i>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">{{__('Messages')}}</span>
        </a>
        <a href="{{route('ride.create')}}" data-tooltip-target="tooltip-post" type="button"
           class="inline-flex flex-col items-center justify-center p-4 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i class="fa-solid fa-circle-plus"></i>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">{{__('Add')}}</span>
        </a>

        <a href="{{route('ride.my-rides')}}" data-tooltip-target="tooltip-search" type="button"
           class="inline-flex flex-col items-center justify-center py-4 px-0 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i class="fa-solid fa-car"></i>
            <span
                class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">{{__('My rides')}}</span>
        </a>
        <a href="{{auth_user_profile_url()}}" data-tooltip-target="tooltip-settings" type="button"
           class="inline-flex flex-col items-center justify-center p-4 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i class="fa-solid fa-user relative"></i>

            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">{{__('Profile')}}</span>
        </a>
    </div>
</div>
