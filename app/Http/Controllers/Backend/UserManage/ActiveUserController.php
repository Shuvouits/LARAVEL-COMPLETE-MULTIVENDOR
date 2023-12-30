<?php

namespace App\Http\Controllers\Backend\usermanage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActiveUserController extends Controller
{
    public function AllUser(){
        $users = User::where('role','user')->latest()->get();
        return view('admin.usermanage.user_all_data',compact('users'));

    } // End Mehtod 

    public function AllVendor(){
        $vendors = User::where('role','vendor')->latest()->get();
        return view('admin.usermanage.vendor_all_data',compact('vendors'));

    } // End Mehtod 
}
