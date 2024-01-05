<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;
use App\Notifications\AdminApproveNotification;
use Illuminate\Support\Facades\Notification;

class ActiveInactiveVendorController extends Controller
{
    public function InactiveVendor(){
        $inActiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('admin.vendor.inactive_vendor',compact('inActiveVendor'));

    }  

    public function ActiveVendor(){
        $ActiveVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('admin.vendor.active_vendor',compact('ActiveVendor'));

    }  

    public function ActiveVendorDetails($id){
        $activeVendorDetails = User::findOrFail($id);
        return view('admin.vendor.active_vendordetails',compact('activeVendorDetails'));
    }

    public function InActiveVendorDetails($id){
        $inactiveVendorDetails = User::findOrFail($id);
        return view('admin.vendor.inactive_vendordetails',compact('inactiveVendorDetails'));
    }  

   

    public function ActiveVendorApprove(Request $request){
    
        
        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'active',
        ]);


        $notification = array(
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        );

        $vuser = User::where('role','vendor')->get();
        Notification::send($vuser, new AdminApproveNotification($request));

        return redirect('/active/vendor')->with($notification);

    }// End Mehtod   

    public function InActiveVendorApprove(Request $request){
    
        
        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'inactive',
        ]);


        $notification = array(
            'message' => 'Vendor InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect('/inactive/vendor')->with($notification);

    }// End Mehtod
}
