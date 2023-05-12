<div>
    <form
        method="POST"
        action="{{route('ride.delete', ['id' => $ride->getId()])}}"
    >
        @csrf
        <button type="submit"
                class="formOnSubmitAsk w-full p-1 text-sm text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            {{__('Delete ride')}}
        </button>
    </form>
</div>
