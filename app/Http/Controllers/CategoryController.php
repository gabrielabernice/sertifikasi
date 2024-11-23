<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // function to create category
    public function create(){
        $category = "";

        // check if category name is filled
        if(isset($_POST['category'])){
            $category = $_POST['category'];
        }

        // create new data
        $categories = new CategoryModel();
        $categories->category = $category;
        $categories->save();

        return redirect('categories');
    }

    // function to read categories
    public function view(){
        $category = CategoryModel::all();
        return view('categories',[
            'categories' => $category
        ]);
    }

    // function to update category
    public function update(){
        $categories = CategoryModel::find($_POST['category_id']);

        if (!isset($_POST['category'])){
            return view('updateCategory',[
                'category' => $categories
            ]);
        }else{
            if(isset($_POST['category'])){
                $category = $_POST['category'];
            }

            // save new data to replace the old one
            $categories->category = $category;
            $categories->save();

            return redirect('categories');
        }
    }

    // function to delete category
    public function delete(){
        $category = CategoryModel::find($_POST['category_id']);

        $category->delete();

        return redirect('categories')->with('success', 'Category has been deleted successfully!');
    }
}
