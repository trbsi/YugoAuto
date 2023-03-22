<?php

declare(strict_types=1);

namespace App\Source\Ride\App\Controllers;

use App\Http\Controllers\Controller;

class RideController extends Controller
{
    public function list()
    {
        return view('ride.list');
    }
}
