<?php

declare(strict_types=1);

namespace App\Source\Report\App\Controllers;

use App\Source\Report\App\Requests\ReportUserRequest;
use App\Source\Report\Domain\ReportUser\ReportUserLogic;
use Illuminate\Support\Facades\Auth;

class ReportController
{
    public function report(
        ReportUserRequest $request,
        ReportUserLogic $logic
    ) {
        $logic->report(
            authUserId: Auth::id(),
            content: $request->report_content,
            reportedUserId: (int)$request->reported_user_id,
        );
        $request->session()->flash('success', __('User has been reported. We will review it.'));
        return redirect()->back();
    }
}
