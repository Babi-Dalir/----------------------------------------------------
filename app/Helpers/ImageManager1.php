<?php
namespace App\Helpers;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class ImageManager1
{
    public static function saveImage($table,$image){
        if($image){
            $name = $image->hashName();
            $manager=new ImageManager(Driver::class);
            $smallImage=$manager->read($image->getRealPath());
            $bigImage=$manager->read($image->getRealPath());
            $smallImage->resize(width:256,height:256);

            Storage::disk('local')->put($table.'/small/'.$name, (string) $smallImage->toPng());
            Storage::disk('local')->put($table.'/big/'.$name, (string) $bigImage->toPng());
            return $name;
        }else{
            return "";
        }
    }
    public static function unlinkImage($table,$object)
    {
        $path_small=public_path(). "/images/$table/small/".$object->image;
        $path_big=public_path(). "/images/$table/big/".$object->image;
        unlink($path_small);
        unlink($path_big);
    }
    public static function ckImage($table,$image){
        if($image){
            $name = $image->hashName();
            $manager=new ImageManager(Driver::class);
            $bigImage=$manager->read($image->getRealPath());

            Storage::disk('local')->put($table.'/big/'.$name, (string) $bigImage->toPng());
            return url("images/$table/big/".$name);
        }
    }
}

?>
