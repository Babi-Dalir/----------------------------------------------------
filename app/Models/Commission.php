<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'percentage'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function createCommision($request)
    {
        Commission::query()->create([
            'category_id'=>$request->input('category_id'),
            'percentage'=>$request->input('percentage'),
        ]);
    }
    public static function updateCommision($request,$id)
    {
        $commission = Commission::query()->find($id);
        $commission->update([
            'category_id'=>$request->input('category_id'),
            'percentage'=>$request->input('percentage'),
        ]);
    }
}
