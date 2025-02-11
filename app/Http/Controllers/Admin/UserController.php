<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager ;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ="لیست کاربران";
        return view('admin.users.list',compact("title"));

    }


    public function create()
    {
        $title ="ایجاد کاربر";

        return view('admin.users.create',compact("title"));
    }


    public function store(CreateUserRequest $request)
    {
        User::createUser($request);
        return redirect()->route('user.index')->with('message','کابر جدید با موفقیت ثبت شد');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $title ="ویرایش کاربر";

        $user=User::findOrFail($id);
        return view('admin.users.edit',compact('user','title'));
    }


    public function update(EditUserRequest $request, string $id)
    {
        $user=User::findOrFail($id);
        User::updateUser($request,$user);
        return redirect()->route('user.index')->with('message','کابر جدید با موفقیت ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }
    public function createUserRole($id){
        $user=User::query()->find($id);
        $roles=Role::query()->get();
        return view('admin.users.user_roles',compact('user','roles'));
    }
    public function storeUserRole(Request $request,$id){
        $user=User::query()->find($id);
        $user->syncRoles($request->roles);
        return redirect()->route('user.index')->with('message','کابر به نقش متصل شد');
    }

    public function sellers()
    {
        $title ="لیست فروشندگان";
        return view('admin.sellers.list',compact("title"));
    }
}
