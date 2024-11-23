<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{

    // function to create book
    public function create(Request $request){
        $title = "";
        $author = "";
        $description = "";
        $publish = "";
        $available = "";

        // check whether all data has been filled
        if(isset($_POST['title'])){
            $title = $_POST['title'];
        }
        if(isset($_POST['author'])){
            $author = $_POST['author'];
        }
        if(isset($_POST['description'])){
            $description = $_POST['description'];
        }
        if(isset($_POST['publish'])){
            $publish = $_POST['publish'];
        }
        if(isset($_POST['category_id'])){
            $categories = $_POST['category_id'];
        }
        if(isset($_POST['available'])){
            $available = $_POST['available'];
        }

        // creating the new data
        $book = new BookModel();
        $book->title = $title;
        $book->author = $author;
        $book->description = $description;
        $book->published_date = $publish;
        $book->is_available = $request->has('available') ? 1 : 0;
        $book->save();

        // if the category is selected, get the category and attach it
        if (!empty($categories)) {
            $book->category()->attach($categories);
        }

        return redirect('books');
    }

    // function to read the boosk
    public function view(Request $request){
        $categories = CategoryModel::all();

        // check whether a category has been selected
        if ($request->isMethod('post') && $request->has('category_id') && $request->category_id != 0) {
            $categoryId = $request->input('category_id');
            // selected books based on the category
            $filteredBooks = BookModel::whereHas('category', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })->get();
        } else {
            // show all books
            $filteredBooks = BookModel::all();
        }

        return view('books', compact('filteredBooks', 'categories'));
    }

    // function to edit books
    public function update(Request $request){
        $book = BookModel::find($_POST['book_id']);
        $categories = CategoryModel::all();

        if (!isset($_POST['title'])){
            return view('updateBook',[
                'book' => $book,
                'categories' => $categories
            ]);
        }else{
            if(isset($_POST['title'])){
                $title = $_POST['title'];
            }
            if(isset($_POST['author'])){
                $author = $_POST['author'];
            }
            if(isset($_POST['description'])){
                $description = $_POST['description'];
            }
            if(isset($_POST['publish'])){
                $publish = $_POST['publish'];
            }
            if(isset($_POST['available'])){
                $available = $_POST['available'];
            }

            // take the new data to change the old data
            $book->title = $title;
            $book->author = $author;
            $book->description = $description;
            $book->published_date = $publish;
            $book->is_available = $request->has('available') ? 1 : 0;
            $book->save();

            // take the new category, and detach the old category if its not selected
            if (isset($_POST['category_id']) && is_array($_POST['category_id'])) {
                $book->category()->sync($_POST['category_id']);
            } else {
                $book->category()->detach();
            }

            return redirect('books');
        }
    }

    // function to delete books
    public function delete(){
        $book = BookModel::find($_POST['book_id']);

        $book->categories()->detach();
        $book->delete();

        return redirect('books')->with('success', 'Book has been deleted successfully!');
    }
}
