<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;

class FileServices
{
    public static function uploadFile($file, $defaultFile = 'default.jpg', $folder='/'){
        if($file !== null){
            $path = $file->store($folder, 'public');
        }
        else{
            $path = $defaultFile;
        }
        return $path;
    }

    public static function deleteFile($file, $folder="public/", $defaultFiles=['default.jpg', 'logo.jpg']){
        $path = $folder.$file;

        if(Storage::exists($path) && !in_array($file, $defaultFiles)){
            Storage::delete($path);
        }
    }

    public static function updateFile($file, $folder="public/", $defaultFiles=['default.jpg', 'logo.jpg']){
        self::deleteFile($file, $folder, $defaultFiles);
        self::uploadFile($file, $defaultFiles[0], $folder);
    }
}
