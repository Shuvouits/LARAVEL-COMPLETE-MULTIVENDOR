<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class HomeController extends Controller
{
    public function Home(){

        $all_category = Category::orderBy('category_name', 'ASC')->get(); 
        $limit_category = Category::orderBy('category_name', 'ASC')->limit(7)->get(); 

        $category_with_sub = Category::join('sub_categories', 'categories.id', '=', 'sub_categories.category_id')
                         ->select('categories.id', 'categories.category_name')
                         ->groupBy('categories.id', 'categories.category_name')
                         ->get();

                         

        $category_without_sub = Category::join('sub_categories', 'categories.id', '!=', 'sub_categories.category_id')
                         ->select('categories.id', 'categories.category_name')
                         ->groupBy('categories.id', 'categories.category_name')
                         ->limit(4)
                         ->get();

        $all_subcategory = SubCategory::all();
       
        return view('frontend.index', compact('all_category','limit_category', 'category_with_sub', 'all_subcategory', 'category_without_sub'));
    }
}
