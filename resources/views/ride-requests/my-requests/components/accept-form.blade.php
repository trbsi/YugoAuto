<?php
/** @var \App\Models\Ride $ride */

/** @var \App\Models\RideRequest $request */
?>
<form
    method="POST"
    action="{{route('ride-request.accept-reject')}}"
>
    @csrf
    <input type="hidden" name="ride_request_id" value="{{$request->getId()}}">
    <input type="hidden" name="status" value="{{\App\Source\RideRequest\Enum\RideRequestEnum::ACCEPTED->value}}">
    <button type="submit"
            class="formOnSubmitAsk w-full p-1 text-sm text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        {{__('Accept')}}
    </button>
</form>
