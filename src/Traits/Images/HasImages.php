<?php

namespace Helvetiapps\LiveControls\Traits\Images;

use Helvetiapps\LiveControls\Scripts\Images\ImagesHandler;

trait HasImages
{
    protected $imageColumn = 'image';
    protected $imagePrivate = false;

    public function uploadImage($image): bool
    {
        $photoLocation = ImagesHandler::uploadImage($image, $this->imageColumn, $this->imagePrivate);

        return $this->update([
            $this->imageColumn => $photoLocation
        ]);
    }

    public function removeImage(string $photoLocation, bool $isPrivate = null)
    {
        return ImagesHandler::deleteImage($photoLocation, is_null($isPrivate) ? $this->imagePrivate : $isPrivate);
    }
}