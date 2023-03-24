<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Services;

use App\Enum\RoleEnum;
use App\Models\User;

class GetAdminEmailsService
{
    public function getAdminEmails(): array
    {
        $users = User::role(RoleEnum::ROLE_SUPER_ADMIN->value)->get();
        $emails = [];

        /** @var User $user */
        foreach ($users as $user) {
            if (str_ends_with($user->getAnyEmail(), 'test.com')) {
                continue;
            }
            $emails[] = $user->getAnyEmail();
        }

        return $emails;
    }
}
