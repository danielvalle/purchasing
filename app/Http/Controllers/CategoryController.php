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
        $category = Category::create(array(
                'category_name' =>trim($request->input('add-category-name')),
                'is_active' => 1
            ));

        $added = $category->save();

        return redirect('maintenance/category');
    }

    public function update(Request $request)
    {

    	$category = Category::find($request->input('edit-category-id'));
        $category->category_name = trim($request->input('edit-category-name'));
        $category->save();

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


