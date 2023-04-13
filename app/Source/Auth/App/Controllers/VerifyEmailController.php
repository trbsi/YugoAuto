<?php

namespace App\Source\Auth\App\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Source\Auth\App\Requests\VerifyEmailRequest;
use Illuminate\Auth\Events\Verified;
use Laravel\Fortify\Contracts\VerifyEmailResponse;

class VerifyEmailController extends Controller
{
    public function verify(VerifyEmailRequest $request)
    {
        $user = User::find($request->route('id'));
        if ($user->hasVerifiedEmail()) {
            return app(VerifyEmailResponse::class);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return app(VerifyEmailResponse::class);
    }
}
