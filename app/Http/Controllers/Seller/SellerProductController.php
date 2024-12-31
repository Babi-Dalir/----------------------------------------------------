<?php

namespace App\Http\Controllers\Seller;

use App\Enums\CompanyStatus;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Guaranty;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller
{
    public function sellerCreateProduct()
    {
        $title = "ایجاد محصول";
        $categories = Category::getCategories();
        $brands = Brand::query()->pluck('title','id');
        $tags = Tag::query()->pluck('title','id');
        $guaranties = Guaranty::query()->pluck('title','id');
        $colors = Color::query()->pluck('title','id');

        return view('seller.seller_products.create',compact('title','categories','brands','tags','guaranties','colors'));
    }

    public function sellerStoreProduct(Request $request)
    {
        Product::sellerCreateProduct($request);
        return redirect()->route('products.index')->with('message',"محصول با موفقیت ایجاد شد");
    }
    public function sellerProducts()
    {
        $title = 'لیست محصولات فروشده';
        return view('seller.seller_products.list',compact('title'));
    }
}
