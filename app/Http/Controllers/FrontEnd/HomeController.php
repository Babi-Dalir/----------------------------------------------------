<?php

namespace App\Http\Controllers\FrontEnd;

use App\Enums\CartType;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductGuaranty;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function home(){
        $sliders=Cache::remember('sliders',60*60*24*7,function(){
            return Slider::query()->get();
        });
        $brands=Cache::remember('brands',60*60*24*7,function(){
            return Brand::query()->get();
        });
        $most_sold=Product::query()->with('category')->orderBy('sold','DESC')->limit(8)->get();
        $newest_products=Product::query()->with('category')->orderBy('updated_at','DESC')->limit(8)->get();
        $spacial_products =ProductGuaranty::query()->with('product')
        ->where('spacial_start','<=',now())
        ->where('spacial_expiration','>=',now())
        ->where('count','>',0)
        ->get();
        return view('frontend.index',
        compact('sliders','brands','newest_products',
        'most_sold','spacial_products'));
    }
    public function cart(){
        $cart_count=Cart::query()
            ->where('type',CartType::Main->value)
            ->where('user_id',auth()->id())
            ->count();
        return view('frontend.cart',compact('cart_count'));
    }
    public function shopping(){
        $cart_count=Cart::query()->where('type',CartType::Main->value)->count();
        return view('frontend.shopping',compact('cart_count'));
    }
    public function shoppingPayment(){
        return view('frontend.shopping_payment');
    }
}
