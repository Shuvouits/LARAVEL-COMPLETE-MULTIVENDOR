<?php

namespace App\Http\Controllers\Backend\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $all_brand = Brand::all();
        return view('admin.brand.all_brand', compact('all_brand'));
    }

    public function AddBrand(){
        return view('admin.brand.add_brand');
    }

    public function BrandStore(Request $request){
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url,
        ]);
        $notification = array(
            'message' => 'Insert New Brand ',
            'alert-type' => 'success'
        );

        return redirect('/all/brand')->with($notification);
    }

    public function EditBrand($id){
        $brand_data = Brand::find($id);
        return view('admin.brand.edit_brand', compact('brand_data'));
    }  

    public function UpdateBrand(Request $request){

        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen; 

        if (file_exists($old_img)) {
            unlink($old_img);
        } 

        Brand::findOrFail($brand_id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url, 
        ]);  

        $notification = array(
            'message' => 'Brand Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect('/all/brand')->with($notification); 

        }else{

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)), 
            ]);

            $notification = array(
                'message' => 'Brand Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect('/all/brand')->with($notification); 
        }
    }  

    public function DeleteBrand($id){
        $brand = Brand::find($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::find($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }  
}
