<?php

namespace Helvetiapps\LiveControls\Scripts\Images;

use Exception;
use Helvetiapps\LiveControls\Facades\PermissionsHandler;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class ImagesHandler
{
    /**
     * Uploads an image
     *
     * @param [type] $image The image from a request $request->file('somefile')
     * @param string $key The key (subfolder) the image should be saved to
     * @param boolean $isPrivate If the private or public disk should be used
     * @param array $options quality => sets quality of image, transform_to_jpeg => transforms image to jpeg
     * @return string
     */
    public static function uploadImage($image, string $key = 'image', bool $isPrivate = false, array $options = []): string
    {
        if(!static::checkPermissions('upload')){
            abort(403);
        }

        $quality = array_key_exists('quality', $options) && is_numeric($options["quality"]) ? $options["quality"] : null;
        $transform = array_key_exists('transform_to_jpeg', $options) && is_bool($options["transform_to_jpeg"]) ? $options['transform_to_jpeg'] : false;

        $disk = $isPrivate ? config('livecontrols.images_disk_private') : config('livecontrols.images_disk');
        //HANDLE IMAGE
        if(is_null($image)){
            throw new Exception('Image does not exist!');
        }else{
            $imageLocation = $image->store($key, $disk);

            $diskroot = config('filesystems.disks.'.($disk).'.root');

            $filePath = $diskroot.'/'.$imageLocation;
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
                    $imageLocation = explode('.', $imageLocation)[0].'.jpg';
                }elseif($ftype == Image::JPEG){
                    $img->save($filePath, $quality);
                }
            }else{
                $img->save($filePath, $quality);
            }
        }

        return $imageLocation;
    }

    public static function deleteImage(string $imageLocation, bool $isPrivate = false):bool{
        if(!static::checkPermissions('delete')){
            abort(403);
        }
        $disk = $isPrivate ? config('livecontrols.images_disk_private') : config('livecontrols.images_disk');
        return Storage::disk($disk)->delete($imageLocation);
    }

    public static function imageUrl($imageLocation, bool $isPrivate = false){
        if(!static::checkPermissions('show')){
            abort(403);
        }
        $disk = $isPrivate ? config('livecontrols.images_disk_private') : config('livecontrols.images_disk');
        return Storage::disk($disk)->url($imageLocation);
    }

    public static function imagePath($imageLocation, bool $isPrivate = false){
        $disk = $isPrivate ? config('livecontrols.images_disk_private') : config('livecontrols.images_disk');
        return Storage::disk($disk)->path($imageLocation);
    }

    public static function checkPermissions(string $permission):bool{
        if(config('livecontrols.images_enabled', true) == false){
            //If images system is disabled it will always return false
            return false;
        }
        if(config('livecontrols.images_permissions_enabled', false) == false){
            //This will ignore the check
            return true;
        }
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
