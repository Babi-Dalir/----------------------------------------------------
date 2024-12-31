<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGuarantyRequest;
use App\Models\Color;
use App\Models\Guaranty;
use App\Models\Product;
use App\Models\ProductGuaranty;
use Illuminate\Http\Request;

class ProductGuarantyController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $title='لیست تنوع قیمت محصول';
        return view('admin.product_guaranties.list',compact('title','product_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $title='ایجاد تنوع قیمت محصول ';
        $guaranties=Guaranty::query()->pluck('title','id');
        $product=Product::query()->find($id);
        $colors=Color::query()->pluck('title','id');

        return view('admin.product_guaranties.create',compact('title','guaranties','colors','product'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGuarantyRequest $request,$product_id)
    {
        ProductGuaranty::createProductGuaranty($request,$product_id);
        return redirect()->route('products.index')->with('message','محصول با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,$product_id)
    {
        $title='ویرایش  تنوع قیمت محصول ';
        $guaranties=Guaranty::query()->pluck('title','id');
        $product=Product::query()->find($product_id);
        $product_guaranty=ProductGuaranty::findOrFail($id);
        $colors=Color::query()->pluck('title','id');

        return view('admin.product_guaranties.edit',compact('title','guaranties','product','product_guaranty','colors'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,$product_id)
    {
        ProductGuaranty::updateProductGuaranty($request,$id,$product_id);

        return redirect()->route('products.index')->with('message','تنوع قیمت محصول با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
