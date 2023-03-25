<?php
/** @var \App\Models\Ride $ride */

/** @var \App\Models\RideRequest $request */
?>
<div class="mr-2">
    <form
        method="POST"
        action="{{route('ride-request.accept-reject')}}"
        onsubmit="return confirm('{{__('Are you sure?')}}');"
    >
        @csrf
        <input type="hidden" name="ride_id" value="{{$ride->getId()}}">
        <input type="hidden" name="user_id" value="{{$request->getPassengerId()}}">
        <input type="hidden" name="status" value="{{\App\Source\RideRequest\Enum\RideRequestEnum::ACCEPTED->value}}">
        <div class=" mb-6">
            <button type="submit"
                    class="px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{__('Accept')}}
            </button>
        </div>
    </form>
</div>
