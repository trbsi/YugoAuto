<?php

namespace App\Source\Public\App\Controllers;

use App\Source\Public\App\Requests\ContactRequest;
use App\Source\Public\Domain\Contact\ContactLogic;
use Illuminate\Support\Facades\Auth;

class PublicController
{
    public function sendMessage(
        ContactRequest $request,
        ContactLogic $ogic
    ) {
        if (Auth::id()) {
            $ogic->sendForAuthUser(Auth::id(), $request->message);
        } else {
            $ogic->sendForGuest(
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
