<?php
namespace App\Helpers;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    public static function saveContact($file,$company){
        if($file){
            $name = $file->hashName();
            Storage::disk('files')->put('/contracts/'.$company,$file);
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
