<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Services;

class GetAdminEmailsService
{
    public function getAdminEmails(): array
    {
        return [
            config('mail.admin_email')
        ];
        /*
         $emails= [];
         $users = User::role(RoleEnum::ROLE_SUPER_ADMIN->value)->get();
        foreach ($users as $user) {
            if (str_ends_with($user->getAnyEmail(), 'test.com')) {
                continue;
            }
            $emails[] = $user->getAnyEmail();
        }

        return $emails;*/
    }
}
