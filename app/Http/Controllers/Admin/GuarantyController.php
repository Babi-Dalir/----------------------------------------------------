<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guaranty;
use Illuminate\Http\Request;

class GuarantyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title='لیست گارانتی ها';
        return view('admin.guaranties.list',compact('title'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title='ایجاد گارانتی';
        return view('admin.guaranties.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Guaranty::createGuaranty($request);
        return redirect()->route('guaranties.index')->with('message','گارانتی با موفقیت ایجاد شد');
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
        $title='ویرایش گارانتی';
        $title='ویرایش تگ ها';
        $guaranty=Guaranty::query()->find($id);
        return view('admin.guaranties.edit',compact('title','guaranty'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Guaranty::updateGuaranty($request,$id);
        return redirect()->route('guaranties.index')->with('message','گارانتی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
