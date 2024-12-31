<?php

namespace App\Models;

use App\Helpers\ImageManager1;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'url'
    ];

    public static function createSlider($request)
    {
        Cache::forget('sliders');
        Slider::query()->create([
            'url'=>$request->input('url'),
            'image'=>ImageManager1::saveImage('sliders',$request->image),
        ]);
    }
    public static function updateSlider($request,$slider)
    {
        Cache::forget('sliders');
        $slider->update([
            'url'=>$request->input('url'),
            'image'=>$request->image ? ImageManager1::saveImage('sliders',$request->image) : $slider->image,
        ]);
    }
}
