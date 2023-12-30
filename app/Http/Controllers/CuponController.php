<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cupon;
use Carbon\Carbon;

class CuponController extends Controller
{
    public function AllCoupon(){
        $coupon = Cupon::latest()->get();
        return view('admin.coupon.coupon_all',compact('coupon'));
    } // End Method 

    public function AddCoupon(){
        return view('admin.coupon.coupon_add');
    }

    public function StoreCoupon(Request $request){ 
        Cupon::insert([

            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        ); 

        return redirect('/all/coupon')->with($notification); 

    }

    public function EditCoupon($id){

        $coupon = Cupon::findOrFail($id);
        return view('admin.coupon.edit_coupon',compact('coupon'));

    }// End Method 

    public function UpdateCoupon(Request $request){

        $coupon_id = $request->id;

         Cupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect('/all/coupon')->with($notification); 


    }// End Method 

    public function DeleteCoupon($id){

        Cupon::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 
}
