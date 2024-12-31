<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyGroupRequest;
use App\Models\Category;
use App\Models\Commission;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class CommissionController extends Controller
{/**
 * Display a listing of the resource.
 */
    public function index()
    {
        $title='لیست کمیسیون ها';
        return view('admin.commissions.list',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title=' ایجاد کمیسیون';
        $categories=Category::getLevel3Categories();
        // $categories=Category::query()->where('parent_id')->pluck('title','id'); برای وقتی که فقط دسته بندی های اصلی را بیاورد به جای خط کد بالا قرار میدیم
        return view('admin.commissions.create',compact('title','categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Commission::createCommision($request);
        return redirect()->route('commissions.index')->with('message','کمیسیون با موفقیت ایجاد شد');
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
    public function edit(string $id)
    {
        $title='ویرایش  کمیسیون ها ';
        $categories=Category::getLevel3Categories();
        $commission=Commission::query()->findOrFail($id);
        return view('admin.property_groups.edit',compact('title','categories','commission'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Commission::updateCommision($request,$id);

        return redirect()->route('commissions.index')->with('message','کمیسیون با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
