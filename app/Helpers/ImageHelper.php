<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper{

    public static function generateImage($path, $type = 'main'){
        if($path == null || $path == ''){
            return Storage::url('assets/image/background/no_image_found.jpg');
        }
        if(!Storage::disk('public')->exists($path)){
            return Storage::url('assets/image/background/no_image_found.jpg');
        }
        if($type == 'main'){
            return Storage::url($path);
        }else{
            $file_base_name = basename($path);
            $file_extension = pathinfo($file_base_name, PATHINFO_EXTENSION);
            $file_name_with_url = str_replace('.'.$file_extension, '', $path);

            $newFile = $file_name_with_url.'_'.$type.'.'.$file_extension;

            return Storage::url($newFile);
        }
    }

    public static function generateVideo($path, $type = 'main'){
        if($path == null || $path == ''){
            return Storage::url('assets/image/background/no_image_found.png');
        }
        if($type == 'main'){
            return Storage::url($path);
        }else{
            $file_base_name = basename($path);
            $file_extension = pathinfo($file_base_name, PATHINFO_EXTENSION);
            $file_name_with_url = str_replace('.'.$file_extension, '', $path);

            $newFile = $file_name_with_url.'_'.$type.'.'.$file_extension;

            return Storage::url($newFile);
        }
    }

}
