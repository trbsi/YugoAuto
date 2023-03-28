<footer class=" bg-white rounded-lg shadow m-4 dark:bg-gray-800">
    <div class="w-full mx-auto container md:p-6 p-4 md:flex md:items-center md:justify-between">
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{date('Y')}}</span>
            </li>
            &nbsp;|&nbsp;
            <li>
                <a href="{{route('contact')}}" class="underline">{{__('Contact')}}</a>
            </li>
        </ul>
        <div class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
            Icon by <a href="https://freeicons.io/profile/5790">ColourCreatype</a> on <a href="https://freeicons.io">freeicons.io</a>
        </div>
    </div>
</footer>
