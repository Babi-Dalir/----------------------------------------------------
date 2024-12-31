<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'province',
    ];

    public function cities(){
        return $this->hasMany(City::class);
    }
    
    public static function createProvice($request){
        self::query()->create([
            'province'=>$request->input('province'),
        ]);

    }
    public static function updateProvice($request,$id){
        $province=self::query()->find($id);
        $province->update([
            'province'=>$request->input('province'),
        ]);

    }
}
