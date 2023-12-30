<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cupon;
use App\Models\ShipDivision;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;

class CartController extends Controller
{
    public function ProductCart(Request $request){

        if(Session::has('coupon')){
            Session::forget('coupon');
        }


        $formData = $request->all();

        
        $product_id = $formData['product_id'];
        $product_size = $formData['product_size'] ?? '';
        $product_color = $formData['product_color'] ?? '';
        $product_quantity = $formData['quantity'];


        $vendor_id = $formData['vendor_id'];


       

        $product = Product::findOrFail($product_id);

        if($product->discount_price == NULL){
            Cart::add([

                'id' => $product_id,
                'name' => $product->product_name,
                'qty' => $product_quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $product_color,
                    'size' => $product_size,
                    'vendor_id' => $vendor_id,
                ],
            ]);  

            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
    

            return response()->json([
                'success' => 'Successfully Added on Your Cart'
            ]);

        }else{

            Cart::add([

                'id' => $product_id,
                'name' => $product->product_name,
                'qty' => $product_quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $product_color,
                    'size' => $product_size,
                    'vendor_id' => $vendor_id,
                ],
            ]);


            return response()->json(['success' => 'Successfully Added on Your Cart' ]);


        }

    }  

    public function AddMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));
    }  

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);

    }//

    public function MyCart(){
        return view('frontend.mycart.view_mycart');
    } 

    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));

    }// End Method  


    public function CartRemove($rowId){
        Cart::remove($rowId);

        $total_amount = Cart::total();
        $total_amount = str_replace(',', '', $total_amount);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Cupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round($total_amount * $coupon->coupon_discount/100), 
                'total_amount' => round($total_amount - $total_amount * $coupon->coupon_discount/100 )
            ]); 
        }  

       



        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method  


    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty -1);

        $total_amount = Cart::total();
        $total_amount = str_replace(',', '', $total_amount);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Cupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round($total_amount * $coupon->coupon_discount/100), 
                'total_amount' => round($total_amount - $total_amount * $coupon->coupon_discount/100 )
            ]); 
        }  

        return response()->json('Decrement');

    }// End Method  

    public function CartIncrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty +1);

        $total_amount = Cart::total();
        $total_amount = str_replace(',', '', $total_amount);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Cupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round($total_amount * $coupon->coupon_discount/100), 
                'total_amount' => round($total_amount - $total_amount * $coupon->coupon_discount/100 )
            ]); 
        }


        return response()->json('Increment');

    }// End Method  


    public function CouponApply(Request $request){

        $coupon = Cupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

            $total_amount = Cart::total();
            $total_amount = str_replace(',', '', $total_amount);
    
            if ($coupon) {
                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name, 
                    'coupon_discount' => $coupon->coupon_discount, 
                    'discount_amount' => round($total_amount * $coupon->coupon_discount/100), 
                    'total_amount' => round($total_amount - $total_amount * $coupon->coupon_discount/100),
                ]);
    
                return response()->json(array(
                    'validity' => true,                
                    'success' => 'Coupon Applied Successfully',
    
                ));
    
    
            } else{
                return response()->json(['error' => 'Invalid Coupon']);
            }


       



    }// End Method  


    public function CouponCalculation(){

        if (Session::has('coupon')) {

            return response()->json(array(
             'subtotal' => Cart::total(),
             'coupon_name' => session()->get('coupon')['coupon_name'],
             'coupon_discount' => session()->get('coupon')['coupon_discount'],
             'discount_amount' => session()->get('coupon')['discount_amount'],
             'total_amount' => session()->get('coupon')['total_amount'], 
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        } 
    }// End Method  


    public function CouponRemove(){

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);

    }// End Method


    public function CheckoutCreate(){

        if(Auth::check()){

            if(Cart::total() > 0){

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();  

                $divisions = ShipDivision::orderBy('division_name','ASC')->get();

                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal', 'divisions'));


            }else{
                $notification = array(
                    'message' => 'Shopping At list One Product',
                    'alert-type' => 'error'
                );
                return redirect('/')->with($notification); 
            }

        }else{
            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification); 
        }

       
    }// End Method

    
}