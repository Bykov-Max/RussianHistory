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

    public static function updateFile($newFile, $oldFile, $folder = '/'){
        $path = $oldFile;
        if ($newFile != null) {
            $path = $newFile->store($folder, 'public');
            self::deleteFile($oldFile);
        }

        return $path;

    }
}
