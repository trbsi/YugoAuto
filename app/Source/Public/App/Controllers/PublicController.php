<?php

namespace App\Source\Public\App\Controllers;

use App\Source\Public\App\Requests\ContactRequest;
use App\Source\Public\Domain\Contact\ContactBusinessLogic;
use Illuminate\Support\Facades\Auth;

class PublicController
{
    public function sendMessage(
        ContactRequest $request,
        ContactBusinessLogic $businessLogic
    ) {
        if (Auth::id()) {
            $businessLogic->sendForAuthUser(Auth::id(), $request->message);
        } else {
            $businessLogic->sendForGuest(
                $request->name,
                $request->email,
                $request->message
            );
        }

        $request->session()->flash('success', __('Message sent'));
        return redirect()->back();
    }

    public function contact()
    {
        return view('public.contact');
    }
}
