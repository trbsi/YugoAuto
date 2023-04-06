<div class="mt-2">
    <form
        method="POST"
        action="{{route('ride-request.request-ride', ['rideId' => $ride->getId()])}}"
        onsubmit="return confirm('{{__('Are you sure?')}}');"
    >
        @csrf
        <div class=" mb-6">
            <button type="submit"
                    class="w-full px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{__('Send a request')}}
            </button>
        </div>
    </form>
</div>
