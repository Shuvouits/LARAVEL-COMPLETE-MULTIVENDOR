<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\VendorRegisterNotification;
use Illuminate\Support\Facades\Notification;

class VendorController extends Controller
{
    public function VendorDashboard(){
        return view('vendor.index');
    }

    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/vendor/login');
    }

    public function VendorLogin(){
        return view('vendor.vendor_login');
    }  

    public function VendorProfileStore(Request $request){
        $id = Auth::user()->id;
        $vendor_data = User::find($id);

        $vendor_data->name = $request->name;
        $vendor_data->email = $request->email;
        $vendor_data->phone = $request->phone;
        $vendor_data->address = $request->address;
        $vendor_data->vendor_join_date = $request->vendor_join_date; 
        $vendor_data->vendor_info = $request->vendor_info;


        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('AdminBackend/upload/vendor_image/'.$admin_data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('AdminBackend/upload/vendor_image/'),$filename);
            $vendor_data['photo'] = $filename;
        }

        $vendor_data->save();

        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }


    public function VendorProfile(){
        $id = Auth::user()->id;
        $vendor_data = User::find($id);
        return view('vendor.vendor_profile',compact('vendor_data'));
    }

    public function VendorChangePassword(){
        
        return view('vendor.vendor_change_password');
    }

    public function VendorUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with('error', "Old Password Doesn't Match");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', "Password Change Successfully");

    } 

    public function BecomeVendor(){
        return view('auth.become_vendor');

    }  

    public function VendorRegister(Request $request) {

        $vuser = User::where('role','admin')->get();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        

        $user = User::insert([ 
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join_date' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

          $notification = array(
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        );

        Notification::send($vuser, new VendorRegisterNotification($request));

        return redirect('/vendor/login')->with($notification);

    }// End Mehtod 

    

   
}