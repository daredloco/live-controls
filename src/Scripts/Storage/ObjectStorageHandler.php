<?php

namespace Helvetiapps\LiveControls\Scripts\Storage;

use Exception;
use Helvetiapps\LiveControls\Utils\Utils;
use Illuminate\Support\Facades\Storage;

class ObjectStorageHandler
{
    protected static $instance;
    protected bool $throwsException;

    private $disk;
    private $storageDisk;

    /**
     * Creates a new ObjectStorageHandler and will set the static ObjectStorageHandler::instance to it.
     *
     * @param string $disk The name of the disk saved in the filesystems.php configuration file
     * @param boolean $throwsException If set to true, check() will throw an exception and will not return a boolean value
     */
    public function __construct(string $disk, bool $throwsException = false)
    {
        $this->disk = $disk;
        $this->throwsException = $throwsException;

        $this->storageDisk = Storage::disk($disk);
        static::$instance = $this;
    }

    /**
     * Checks if the configurations for the disk exist.
     *
     * @return boolean
     */
    private function check(): bool
    {
        $drvr = config('filesystems.disks.'.$this->disk.'.driver');
        if(is_null($drvr)){
            if($this->throwsException){
                throw new Exception('Disk "'.$this->disk.'" not found! Did you set in in the filesystems configuration file?');
            }
            return false;
        }
        if($drvr != "s3"){
            if($this->throwsException){
                throw new Exception('Driver for Disk "'.$this->disk.'" needs to be "S3" but is "'.$drvr.'"! Did you set in in the filesystems configuration file?"');
            }
            return false;
        }
        return true;
    }

    /**
     * Checks if the path exists inside the disk
     *
     * @param string $path the relative path of the file
     * @return boolean
     */
    public function exists(string $path): bool
    {
        $this->check();
        return $this->storageDisk->exists($path);
    }

    /**
     * Uploads a specific filecontent to the Storage
     *
     * @param string $folder The name of the folder (Can include subfolders)
     * @param $content The content to store
     * @param string|null $fileName The filename, if not set it will be the default (random) filename
     * @return bool|string
     */
    public function put(string $folder, $content, string $fileName = ""): bool|string
    {
        $this->check();
        if(Utils::isNullOrEmpty($fileName)){
            return $this->storageDisk->put($folder, $content);
        }
        return $this->storageDisk->putFileAs(
            $folder, $content, $fileName
        );
    }

    /**
     * Returns the filecontent or null if file not exists
     *
     * @param string $path The relative path to the file
     * @return string|null
     */
    public function get(string $path): string|null
    {
        $this->check();
        return $this->storageDisk->get($path);
    }

    /**
     * Removes the file(s) from the Storage
     *
     * @param string|array $paths The path to the file or an array with paths
     * @return boolean
     */
    public function delete(string|array $paths): bool
    {
        $this->check();
        return $this->storageDisk->delete($paths);
    }

    /**
     * Returns the baseimage string from an image so you can add it to src="", returns null if file cant be found
     *
     * @param string $path The path to the file
     * @return string|null
     */
    public function baseImage(string $path): string|null
    {
        $this->check();
        $content = $this->get($path);
        if(is_null($content)){
            return null;
        }
        return 'data:image/jpeg;base64,'.base64_encode($content);
    }
}