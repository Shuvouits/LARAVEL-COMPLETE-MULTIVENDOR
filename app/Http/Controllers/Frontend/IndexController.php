<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;

class IndexController extends Controller
{
    public function ProductDetails($id, $slug){
        $product = Product::findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);
        

        $size = $product->product_size;
        $product_size = explode(',', $size);
        $multiImage = MultiImg::where('product_id',$id)->get();
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        return view('frontend.product.product_details', compact('product','product_color', 'product_size','multiImage','relatedProduct'));
    }

    public function VendorDetails($id){
        $vendor = User::findOrFail($id);
        $vendor_products = Product::where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.vendor.vendorDetails', compact('vendor_products','vendor'));

    }

    public function AllVendor(){
        $vendors = User::where('role', 'vendor')->where('status','active')->orderBy('id','DESC')->get();
        return view('Frontend.vendor.vendor_all', compact('vendors'));
    }  

    public function CatWiseProduct($id, $slug){
        $products = Product::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();
        $breadcat = Category::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.category_view',compact('products','categories', 'breadcat', 'newProduct'));

    }

    public function SubCatWiseProduct($id, $slug){
        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();
        $breadcat = SubCategory::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.subcategory_view',compact('products','categories', 'breadcat', 'newProduct'));

    }

    public function ProductSearch(Request $request){

        $request->validate(['search' => "required"]);

        $item = $request->search;
        $categories = Category::orderBy('category_name','ASC')->get();
        $products = Product::where('product_name','LIKE',"%$item%")->get();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.search',compact('products','item','categories','newProduct'));

    }// End Method 

    public function SearchProduct(Request $request){

        $request->validate(['search' => "required"]);
 
         $item = $request->search;
         $products = Product::where('product_name','LIKE',"%$item%")->select('product_name','product_slug','product_thambnail','selling_price','id')->limit(6)->get();
 
         return view('frontend.product.search_product',compact('products'));
 
      }// End Method 
}