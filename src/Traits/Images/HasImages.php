<?php

namespace Helvetiapps\LiveControls\Traits\Images;

use Exception;
use Helvetiapps\LiveControls\Facades\PermissionsHandler;
use Illuminate\Support\Facades\Storage;
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
        if(!$this->checkPermissions('upload')){
            abort(403);
        }

        $quality = array_key_exists('quality', $options) && is_numeric($options["quality"]) ? $options["quality"] : null;
        $transform = array_key_exists('transform_to_jpeg', $options) && is_bool($options["transform_to_jpeg"]) ? $options['transform_to_jpeg'] : false;

        $disk = $isPrivate ? config('livecontrols.images_disk_private') : config('livecontrols.images_disk');
        //HANDLE IMAGE
        if(is_null($image)){
            throw new Exception('Image does not exist!');
        }else{
            $photolocation = $image->store($key, $disk);

            $diskroot = config('filesystems.disks.'.($disk).'.root');

            $filePath = $diskroot.'/'.$photolocation;
            $img = Image::fromFile($filePath);

            if(config('filesystems.disks.'.($disk).'.driver') != 'local'){
                throw new Exception('Only disks with the local driver are allowed!');
            }

            if($transform == true){
                $ftype = Image::detectTypeFromFile($filePath);
                if($ftype == Image::PNG){
                    //Transform to JPEG
                    $flocation = explode('.', $filePath)[0];
                    $img->save($flocation.'.jpg', $quality);
                    unlink($filePath);
                    $filePath = $flocation.'.jpg';
                }elseif($ftype == Image::JPEG){
                    $img->save($filePath, $quality);
                }
            }else{
                $img->save($filePath, $quality);
            }
        }
        
        return Storage::disk($disk)->url($photolocation);
    }

    public function downloadImage(string $name, string $key = 'image', bool $isPrivate = false){
        if(!$this->checkPermissions('show')){
                    abort(403);
        }
    }

    public function deleteImage(string $name, string $key = 'image', bool $isPrivate = false){
        if(!$this->checkPermissions('delete')){
            abort(403);
        }
    }

    public function getUrl(string $name, string $key = 'image', bool $isPrivate = false){
        if(!$this->checkPermissions('show')){
            abort(403);
        }
    }

    private function checkPermissions(string $permission):bool{
        //TODO: Check if the user has permissions from the config if enabled
        if($permission == "upload"){
            $perm = config('livecontrols.images_permission_upload', null);
            if(is_null($perm)){
                return true;
            }
            return PermissionsHandler::add($permission)->check();
        }elseif($permission == "show"){
            $perm = config('livecontrols.images_permission_show', null);
            if(is_null($perm)){
                return true;
            }
            return PermissionsHandler::add($permission)->check();
        }elseif($permission == "delete"){
            $perm = config('livecontrols.images_permission_delete', null);
            if(is_null($perm)){
                return true;
            }
            return PermissionsHandler::add($permission)->check();
        }
        throw new Exception('Invalid permission! Valid permissions are "upload", "show", "delete" but found "'.$permission.'"');
    }
}