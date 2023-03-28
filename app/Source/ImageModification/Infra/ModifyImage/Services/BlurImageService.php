<?php

declare(strict_types=1);

namespace App\Source\ImageModification\Infra\ModifyImage\Services;

use Intervention\Image\Image as InterventionImage;

class BlurImageService
{
    public function blur(InterventionImage $image, int $blur): InterventionImage
    {
        return $image->blur($blur);
    }
}
