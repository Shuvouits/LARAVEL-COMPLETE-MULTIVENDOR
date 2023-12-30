<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    
    public function AllCategory(){
        $all_category = Category::all();
        return view('admin.category.all_category', compact('all_category'));
    }   

    public function AddCategory(){
        return view('admin.category.add_category');
    }

    public function CategoryStore(Request $request){
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' =>strtolower(str_replace(' ','-',$request->category_name)),
            'category_image' => $save_url,
        ]);
        $notification = array(
            'message' => 'Insert New Category ',
            'alert-type' => 'success'
        );

        return redirect('/all/category')->with($notification);
    }   

    public function EditCategory($id){
        $category_data = Category::find($id);
        return view('admin.category.edit_category', compact('category_data'));
    }     


    

    public function UpdateCategory(Request $request){
        $category_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('category_image')) {

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen; 

        if (file_exists($old_img)) {
            unlink($old_img);
        } 

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url, 
        ]);  

        $notification = array(
            'message' => 'Category Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect('/all/category')->with($notification); 

        }else{

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)), 
            ]);

            $notification = array(
                'message' => 'Category Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect('/all/category')->with($notification); 
        }
    }   

    public function DeleteCategory($id){
        $category = Category::find($id);
        $img = $category->category_image;
        unlink($img);

        Category::find($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }  

    public function CategoryView($id){
        $category_data = Category::where('id',$id)->first();

        if($category_data->front_view == 1){
            $category_data->front_view = 0;
        }else{
            $category_data->front_view = 1;
        }
        $category_data->save();

        

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }

}
