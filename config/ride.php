<?php

return [
    //if user cancels the ride 2 hours or less before ride time, user will be able to rate other user
    'cancel_ride_threshold_in_hours' => (int)env('CANCEL_RIDE_THRESHOLD_IN_HOURS', 2),
];
