<?php
/** @var \App\Models\Ride $ride */

/** @var \App\Models\RideRequest $request */
?>
<div>
    <form
        method="POST"
        action="{{route('ride-request.cancel')}}"
        onsubmit="return confirm('{{__('Are you sure?')}}');"
    >
        @csrf
        <input type="hidden" name="ride_id" value="{{$ride->getId()}}">
        <input type="hidden" name="passenger_id" value="{{$request->getPassengerId()}}">
        <input type="hidden" name="status" value="{{\App\Source\RideRequest\Enum\RideRequestEnum::CANCELLED->value}}">
        <div class=" mb-6">
            <button type="submit"
                    class="px-3 py-2 text-xs font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                {{__('Cancel ride')}}
            </button>
        </div>
    </form>
</div>
