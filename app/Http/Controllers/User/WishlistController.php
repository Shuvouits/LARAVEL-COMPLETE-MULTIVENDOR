<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $product_id){

        if(Auth::check()){
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if(!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
    
                ]);
             $wishlist_count = Wishlist::count();
                return response()->json([
                    'success' => 'Successfully Added On Your Wishlist',
                    'count' => $wishlist_count 
                ]);
            }else{
                return response()->json(['error' => 'This Product Has Already on Your Wishlist' ]);
            }

        }else{
            return response()->json([
                "error"=> "At First Login Your Account"
            ]);
        }

    } 


    public function WishlistView(){
       
        return view('frontend.product.product_wishlist');
    }

    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

        $wishQty = wishlist::where('user_id', Auth::id())->count(); 

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }// End Method  


    public function WishlistRemove($id){

     Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
     return response()->json(['success' => 'Successfully Product Remove' ]);
    }// End Method

   
}