<?php

declare(strict_types=1);

namespace App\Source\ImageModification\Infra\ModifyImage\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;

class ModifyImageService
{
    private InterventionImage $image;
    private ChangeSizeImageService $changeSizeImageService;
    private BlurImageService $blurImageService;

    public function __construct(
        ChangeSizeImageService $changeSizeImageService,
        BlurImageService $blurImageService
    ) {
        $this->changeSizeImageService = $changeSizeImageService;
        $this->blurImageService = $blurImageService;
    }

    public function createImage(string $imagePath): self
    {
        $imagePath = Storage::disk('public')->path($imagePath);
        $this->image = Image::make($imagePath);
        return $this;
    }

    public function getImage(): InterventionImage
    {
        return $this->image;
    }

    public function resize(int $height, int $width): self
    {
        $this->image = $this->changeSizeImageService->resize($this->image, $height, $width);
        return $this;
    }

    public function orientate(): self
    {
        $this->image = $this->image->orientate();
        return $this;
    }

    public function blur(int $blur): self
    {
        $this->image = $this->blurImageService->blur($this->image, $blur);
        return $this;
    }
}
