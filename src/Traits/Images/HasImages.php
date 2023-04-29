<?php

namespace Helvetiapps\LiveControls\Traits\Images;

use Exception;
use Nette\Utils\Image;

trait HasImages{
    protected $imagesTable = null;
    protected $imagesColumns = ['image' => 'image']; //This should be key => value, with key first and database column afterwards
    protected $imagesFolder = null; //If this is set, it will overwrite the config('livecontrols.images_folder)

    /**
     * Uploads an image 
     *
     * @param [type] $image The image from a request $request->file('somefile')
     * @param string $key The key (subfolder) the image should be saved to
     * @param boolean $isPrivate If the private or public disk should be used
     * @param array $options quality => sets quality of image, transform_to_jpeg => transforms image to jpeg
     * @return string
     */
    public function uploadImage($image, string $key = 'image', bool $isPrivate = false, array $options = []): string
    {
        $quality = array_key_exists('quality', $options) && is_numeric($options["quality"]) ? $options["quality"] : null;
        $transform = array_key_exists('transform_to_jpeg', $options) && is_bool($options["transform_to_jpeg"]) ? $options['transform_to_jpeg'] : false;

        $disk = $isPrivate ? config('livecontrols.images_disk_private') : config('livecontrols.images_disk');
        //HANDLE IMAGE
        if(is_null($image)){
            throw new Exception('Image does not exist!');
        }else{
            $photolocation = $image->store($key, $disk);

            throw new Exception($photolocation);
            $diskroot = config('filesystems.disks.'.($disk).'.root');
            $img = Image::fromFile(public_path('uploads/'.$photolocation));

            if(config('filesystems.disks.'.($disk).'.driver') != 'local'){
                throw new Exception('Only disks with the local driver are allowed!');
            }

            if($transform == true){
                $ftype = Image::detectTypeFromFile(public_path('uploads/'.$photolocation));
                if($ftype == Image::PNG){
                    //Transform to JPEG
                    $flocation = explode('.', $photolocation)[0];
                    $img->save(public_path('uploads/'.$flocation.'.jpg'), $quality);
                    unlink(public_path('uploads/'.$photolocation));
                    $photolocation = $flocation.'.jpg';
                }elseif($ftype == Image::JPEG){
                    $img->save(public_path('uploads/'.$photolocation), $quality);
                }
            }else{
                $img->save(public_path('uploads/'.$photolocation), $quality);
            }
            
        }
        return 'path/to/image';
    }

    public function downloadImage(string $name, string $key = 'image'){

    }

    public function deleteImage(string $name, string $key = 'image'){

    }

    public function getUrl(string $name, string $key = 'image'){

    }

    private function checkPermissions():bool{
        //TODO: Check if the user has permissions from the config if enabled
        return false;
    }
}