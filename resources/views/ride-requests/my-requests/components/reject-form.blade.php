<?php
/** @var \App\Models\Ride $ride */

/** @var \App\Models\RideRequest $request */
?>
<form
    method="POST"
    action="{{route('ride-request.accept-reject')}}"
    onsubmit="return confirm('{{__('Are you sure?')}}');"
>
    @csrf
    <input type="hidden" name="ride_request_id" value="{{$request->getId()}}">
    <input type="hidden" name="status" value="{{\App\Source\RideRequest\Enum\RideRequestEnum::REJECTED->value}}">
    <div class=" mb-6">
        <button type="submit"
                class="w-full p-1 text-sm text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            {{__('Reject')}}
        </button>
    </div>
</form>
