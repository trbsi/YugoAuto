<div class="mt-2">
    <form
        method="POST"
        action="{{route('ride.delete', ['id' => $ride->getId()])}}"
        onsubmit="return confirm('{{__('Are you sure?')}}');"
    >
        @csrf
        <div class=" mb-6">
            <button type="submit"
                    class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                {{__('Delete')}}
            </button>
        </div>
    </form>
</div>
