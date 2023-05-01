<?php

declare(strict_types=1);

namespace App\Source\Auth\App\Controllers;

use App\Source\Auth\App\Requests\VerifyPhoneRequest;
use App\Source\Auth\Domain\PhoneVerificationStatus\PhoneVerificationStatusLogic;
use App\Source\Auth\Domain\VerifyPhoneNumber\LogVerificationErrorLogic;
use App\Source\Auth\Domain\VerifyPhoneNumber\VerifyPhoneNumberLogic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyPhoneNumberController
{
    public function showForm(
        Request $request,
        PhoneVerificationStatusLogic $logic
    ) {
        $user = Auth::user();
        if ($user->isPhoneNumberVerified()) {
            $request->session()->flash('info', __('Phone is verified'));
            return redirect(route('profile.show'));
        }

        $canVerify = $logic->canVerify($user->getId());

        return view(
            'auth.verify-phone-number',
            compact('user', 'canVerify')
        );
    }

    public function canVerify(
        PhoneVerificationStatusLogic $logic
    ) {
        $user = Auth::user();
        $canVerify = $logic->canVerify($user->getId());

        if (!$canVerify) {
            return response()->json(
                [
                    'message' => __('Phone verification quota exceeded')
                ],
                400
            );
        }

        return response()->json();
    }

    public function verifyPhoneNumber(
        string $type,
        VerifyPhoneRequest $request,
        VerifyPhoneNumberLogic $logic
    ) {
        try {
            $logic->increaseLimits(Auth::id());
            $logic->verifyPhoneNumber(
                type: $type,
                userId: Auth::id(),
                verificationId: $request->verification_id,
                phoneNumber: $request->phone_number
            );
            return response()->json();
        } catch (Exception $exception) {
            return response()->json(
                [
                    'message' => $exception->getMessage()
                ],
                400
            );
        }
    }

    public function logVerificationError(
        Request $request,
        LogVerificationErrorLogic $logic
    ): void {
        $request->validate([
            'message' => 'required',
            'phoneNumberInput' => 'required',
        ]);

        $logic->log(
            $request->message,
            $request->phoneNumberInput,
            Auth::user()
        );
    }
}
