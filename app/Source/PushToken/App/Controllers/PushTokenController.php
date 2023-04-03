<?php

namespace App\Source\PushToken\App\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PushToken;
use App\Source\PushToken\App\Requests\SavePushTokenRequest;
use App\Source\PushToken\Infra\SavePushToken\Services\SavePushToken;
use Illuminate\Support\Facades\Auth;

class PushTokenController extends Controller
{
    public function create(SavePushTokenRequest $request, SavePushToken $savePushToken)
    {
        $savePushToken->save(
            userId: Auth::id(),
            deviceId: $request->deviceId,
            platform: $request->platform,
            token: $request->token,
            tokenType: $request->tokenType ?: PushToken::TOKEN_TYPE_FIREBASE
        );
        return response()->json();
    }
}
