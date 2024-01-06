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
        $breadsubcat = SubCategory::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        $brands = Product::select('brand_id')->where('status', 1)->where('subcategory_id', $id)->groupBy('brand_id')->get();
        return view('frontend.product.subcategory_view',compact('products','categories', 'breadsubcat', 'newProduct','id', 'brands'));

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

    public function FilterLowToHigh($id){
        $products = Product::where('subcategory_id', $id)->orderBy('selling_price', 'asc')->get();
        $formattedProducts = [];
        
        foreach ($products as $product) {
            $formattedProducts[] = [
                'product_name' => $product->product_name,
                'product_image' => $product->product_thambnail,
                'product_category' => $product->category->category_name,
                'vendor_name' => $product->vendor->name,
                'selling_price' => $product->selling_price,
                'discount_price' => $product->discount_price,
                'discount_percent' => 100 - round(($product->discount_price * 100) / $product->selling_price),
                'vendor_id' => $product->vendor_id,
                // Add other product attributes as needed
            ];
        }

        return response()->json(['products' => $formattedProducts]);

    }   


    public function FilterHighToLow($id){
        $products = Product::where('subcategory_id', $id)->orderBy('selling_price', 'desc')->get();

        //return response()->json(['products' => $products]);
        $formattedProducts = [];
        
        foreach ($products as $product) {
            $formattedProducts[] = [
                'product_name' => $product->product_name,
                'product_image' => $product->product_thambnail,
                'product_category' => $product->category->category_name,
                'vendor_name' => $product->vendor->name,
                'selling_price' => $product->selling_price,
                'discount_price' => $product->discount_price,
                'discount_percent' => 100 - round(($product->discount_price * 100) / $product->selling_price),
                'vendor_id' => $product->vendor_id,
                // Add other product attributes as needed
            ];
        }

        return response()->json(['products' => $formattedProducts]);

    }  

    public function Featured($id){
        $products = Product::where('subcategory_id', $id)->where('featured', 1)->orderBy('id', 'desc')->get();

        $count = Product::where('subcategory_id', $id)->where('featured', 1)->orderBy('id', 'desc')->count();

        //return response()->json(['products' => $products]);
        $formattedProducts = [];
        
        foreach ($products as $product) {
            $formattedProducts[] = [
                'product_name' => $product->product_name,
                'product_image' => $product->product_thambnail,
                'product_category' => $product->category->category_name,
                'vendor_name' => $product->vendor->name,
                'selling_price' => $product->selling_price,
                'discount_price' => $product->discount_price,
                'discount_percent' => 100 - round(($product->discount_price * 100) / $product->selling_price),
                'vendor_id' => $product->vendor_id,
                'total_product' => $count,
                // Add other product attributes as needed
            ];
        }

        return response()->json(['products' => $formattedProducts]);

    }

    public function PriceFilter(Request $request, $id){

        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');

        
        $products = Product::where('subcategory_id', $id)->whereBetween('discount_price', [$minPrice, $maxPrice])->get();

        $count = Product::where('subcategory_id', $id)->whereBetween('discount_price', [$minPrice, $maxPrice])->count();
        
        $formattedProducts = [];
        
        foreach ($products as $product) {
            $formattedProducts[] = [
                'product_name' => $product->product_name,
                'product_image' => $product->product_thambnail,
                'product_category' => $product->category->category_name,
                'vendor_name' => $product->vendor->name,
                'selling_price' => $product->selling_price,
                'discount_price' => $product->discount_price,
                'discount_percent' => 100 - round(($product->discount_price * 100) / $product->selling_price),
                'vendor_id' => $product->vendor_id,
                'total_product' => $count,
                // Add other product attributes as needed
            ];
        }

        return response()->json(['products' => $formattedProducts]);

    } 

    public function BrandFilter(Request $request, $id){

        $brandIds = $request->input('brand_ids');

        $products = Product::where('subcategory_id', $id)->whereIn('brand_id', $brandIds)->get();

        $count = Product::where('subcategory_id', $id)->whereIn('brand_id', $brandIds)->count();
        
        $formattedProducts = [];
        
        foreach ($products as $product) {
            $formattedProducts[] = [
                'product_name' => $product->product_name,
                'product_image' => $product->product_thambnail,
                'product_category' => $product->category->category_name,
                'vendor_name' => $product->vendor->name,
                'selling_price' => $product->selling_price,
                'discount_price' => $product->discount_price,
                'discount_percent' => 100 - round(($product->discount_price * 100) / $product->selling_price),
                'vendor_id' => $product->vendor_id,
                'total_product' => $count,
                // Add other product attributes as needed
            ];
        }

        return response()->json(['products' => $formattedProducts]);

    }

    



}