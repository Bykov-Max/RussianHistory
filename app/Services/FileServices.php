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

    public static function deleteFile($file, $folder="public/", $defaultFiles='default.jpg'){
        $path = $folder.$file;

        if(Storage::exists($path) && ($file != $defaultFiles)){
            Storage::delete($path);
        }
    }

    public static function updateFile($file, $folder="public/", $defaultFiles='default.jpg'){
        if($file != 0){
            self::deleteFile($file, $folder, $defaultFiles);
        }

        $path = self::uploadFile($file, $defaultFiles, $folder);

        return $path;
    }
}
