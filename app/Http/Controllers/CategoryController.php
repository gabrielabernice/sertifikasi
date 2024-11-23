<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        $category = "";

        if(isset($_POST['category'])){
            $category = $_POST['category'];
        }

        $categories = new CategoryModel();
        $categories->category = $category;
        $categories->save();

        return redirect('categories');
    }

    public function view(){
        $category = CategoryModel::all();
        return view('categories',[
            'categories' => $category
        ]);
    }

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

            $categories->category = $category;
            $categories->save();

            return redirect('categories');
        }
    }

    public function delete(){
        $category = CategoryModel::find($_POST['category_id']);

        $category->delete();

        return redirect('categories')->with('success', 'Category has been deleted successfully!');
    }
}
