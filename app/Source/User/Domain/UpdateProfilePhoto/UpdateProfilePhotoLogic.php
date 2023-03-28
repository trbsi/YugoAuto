<?php

declare(strict_types=1);

namespace App\Source\User\Domain\UpdateProfilePhoto;

use App\Models\User;
use App\Source\ImageModification\Infra\ModifyImage\Services\ModifyImageService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateProfilePhotoLogic
{
    public function __construct(
        private readonly ModifyImageService $modifyImageService
    ) {
    }

    public function modifyPhoto(User $user): void
    {
        Log::info($user->getProfilePhotoPath());
        $image = $this->modifyImageService->createImage($user->getProfilePhotoPath());

        $image
            ->resize(300, 300)
            ->orientate()
            ->getImage()
            ->save(
                Storage::disk('public')->path($user->getProfilePhotoPath()),
                60
            );
    }
}
