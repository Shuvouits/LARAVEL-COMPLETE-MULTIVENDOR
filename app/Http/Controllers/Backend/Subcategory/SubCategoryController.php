<?php

namespace App\Http\Controllers\Backend\Subcategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\models\Category;

class SubCategoryController extends Controller
{
    public function AllSubCategory(){
        $all_subcategory = SubCategory::latest()->get();
        
        return view('admin.subcategory.subcategory_all',compact('all_subcategory'));
    } // End Method  

    public function AddSubCategory(){

        $categories = Category::orderBy('category_name','ASC')->get();
      return view('admin.subcategory.add_subcategory',compact('categories'));

    }// End Method 


    public function StoreSubCategory(Request $request){ 

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
        ]);

        Category::findOrFail($request->category_id)->update([

            'sub_category' => "yes"

        ]);

       $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect('/all/sub-category')->with($notification); 

    }// End Method   

    public function EditSubCategory($id){
        $category_data = Category::orderBy('category_name', 'ASC')->get();
    
        $subcategory_data = SubCategory::find($id);
        return view('admin.subcategory.edit_subcategory', compact('subcategory_data','category_data'));
    }    


    public function UpdateSubCategory(Request $request){
       /*-- $subcategory_id = $request->id;
        SubCategory::find($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)),
        ]); */

        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
           'category_id' => $request->category_id,
           'subcategory_name' => $request->subcategory_name,
           'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
       ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect('/all/sub-category')->with($notification); 

       
    }  

    public function DeleteSubCategory($id){

        $subcat_data = SubCategory::find($id);

        Category::findOrFail($subcat_data->category_id)->update([
            "sub_category" => NULL
        ]);


        SubCategory::find($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }  

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
    
            return json_encode($subcat);

    }// End Method 

}
