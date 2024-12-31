<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'mobile',
        'user_id',
        'province_id',
        'city_id',
        'address',
        'zip_code',
        'is_default',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public static function getUserAdderss($user)
    {
        return Address::query()->where('user_id', $user->id)
        ->where('is_default', true)->first();
    }
}
