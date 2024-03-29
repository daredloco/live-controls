<?php

namespace Helvetiapps\LiveControls\Traits\Images;

use Exception;
use Helvetiapps\LiveControls\Scripts\Images\ImagesHandler;

trait HasImages
{
    protected $imageColumn = 'image';
    protected $imagePrivate = false;
    protected $noImageUrl = null;

    public function uploadImage($image, string $column = null, bool $replace = true, bool $isPrivate = null): bool
    {
        if(is_null($isPrivate)){
            $isPrivate = $this->imagePrivate;
        }
        if(is_null($column)){
            $column = $this->imageColumn;
        }

        if(!$replace && !is_null($this->{$column})){
            throw new Exception('Image in column "'.$column.'" in table "'.$this->getTable().'" already exists and replace is disabled!');
        }elseif($replace && !is_null($this->{$column})){
            $this->removeImage($column, $isPrivate);
        }

        $table = $this->getTable();
        $imageLocation = ImagesHandler::uploadImage($image, $table.'_'.$column, $isPrivate);

        return $this->update([
            $column => $imageLocation
        ]);
    }

    public function removeImage(string $column = null, bool $isPrivate = null)
    {
        if(is_null($column)){
            $column = $this->imageColumn;
        }
        if(is_null($isPrivate)){
            $isPrivate = $this->imagePrivate;
        }
        $imageLocation = $this->{$column};
        if(is_null($imageLocation)){
            return false;
        }
        if(ImagesHandler::deleteImage($this->{$column}, $isPrivate)){
            $this->update([
                $column => null
            ]);
        }
    }

    public function getImageUrl(string $column = null, string $noImage = null){
        if(is_null($column))
        {
            $column = $this->imageColumn;
        }
        $imageLocation = $this->{$column};
        if(is_null($imageLocation)){
            if(is_null($noImage)){
                $noImage = $this->noImageUrl;
            }
            if(!is_null($noImage)){
                return $noImage;
            }
            return null;
        }
        return ImagesHandler::imageUrl($this->{$column});
    }
}