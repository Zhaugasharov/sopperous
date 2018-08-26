<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 02.06.2018
 * Time: 18:57
 */

namespace App\Models;

use Intervention\Image\Facades\Image;

class Helper
{
    public static function resizeImage($path, $filename, $size, $newPath = null){
        $image = Image::make($path.$filename);
        $height = $image->height();
        $width = $image->width();
        $ratio =  $width/$height;

        if($ratio > 1){
            $image->resize($size, $size/$ratio);
        }else{
            $image->resize($size*$ratio, $size);
        }

        if(empty($newPath)){
            $newPath = $path;
            $filename = $size.'x'.$size.'_'.$filename;
        }

        $canvas = Image::canvas($size, $size, '#ffffff');
        $canvas->insert($image, 'center');
        $canvas->save($newPath.$filename);
    }
}