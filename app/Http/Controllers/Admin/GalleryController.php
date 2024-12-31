<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageManager1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function ckeditor_image(Request $request){
        if($request->hasFile('upload')){
            $url=ImageManager1::ckImage('products',$request->upload);
            return response()->json(['url'=>$url]);
        }
    }
}
