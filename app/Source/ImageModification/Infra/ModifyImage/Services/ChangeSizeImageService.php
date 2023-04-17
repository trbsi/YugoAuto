<?php

declare(strict_types=1);

namespace App\Source\ImageModification\Infra\ModifyImage\Services;

use Intervention\Image\Image as InterventionImage;

class ChangeSizeImageService
{
    public function resize(InterventionImage $image, int $height, int $width): InterventionImage
    {
        return $image->resize(
            $width,
            $height,
            function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }
        );
    }
}
