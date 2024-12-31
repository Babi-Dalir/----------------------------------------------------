<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class panelController extends Controller
{
    public function index(){
//        $user = auth()->user();
//        $permissions = $user->getPermissionsViaRoles();
        return view("admin.index");
    }
}
