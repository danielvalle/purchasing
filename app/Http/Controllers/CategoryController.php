<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	
	public function index(){

		$categories = Category::all();

		return view("maintenance.maintenance-category")->with('categories', $categories);
	}

    public function store(Request $request)
    {        
        $category_check = \DB::table('category')
                    ->where('category_name', trim($request->input('add-category-name')))
                    ->first();
        
        if($category_check == null)
        {
            $category = Category::create(array(
                'category_name' => trim($request->input('add-category-name')),
                'is_active' => 1
            ));

            $category->save();

            \Session::flash('category_new_success', "Category is successfully added.");
        }
        else \Session::flash('category_new_fail', "Category already exists.");

        return redirect('maintenance/category');
    }

    public function update(Request $request)
    {
        $category_check = \DB::table('category')
                    ->where('category_name', trim($request->input('edit-category-name')))
                    ->first();
                    
        if($category_check == null)
        {
            $category = Category::find($request->input('edit-category-id'));
            $category->category_name = trim($request->input('edit-category-name'));
            $category->save();

            \Session::flash('category_edit_success', trim($request->input('edit-category-name')) . " is successfully updated.");
            
        }
        else if($category_check->category_name == trim($request->input('edit-category-name')) && $category_check->id != $request->input('edit-category-id'))
        {
            \Session::flash('category_edit_fail', trim($request->input('edit-category-name')) . " already exists.");
        }

        return redirect('maintenance/category');
    }

    public function new_category(Request $request)
    {

    	$category = Category::find($request->input('del-category-id'));

        $category->is_active = 0;
        $category->save();

        return redirect('maintenance/category');
    }


	
}


