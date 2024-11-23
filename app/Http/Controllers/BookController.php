<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    public function create(Request $request){
        $title = "";
        $author = "";
        $description = "";
        $publish = "";
        $available = "";

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

        $book = new BookModel();
        $book->title = $title;
        $book->author = $author;
        $book->description = $description;
        $book->published_date = $publish;
        $book->is_available = $request->has('available') ? 1 : 0;
        $book->save();

        if (!empty($categories)) {
            $book->category()->attach($categories);
        }

        return redirect('books');
    }

    public function view(){
        $book = BookModel::all();
        $categories = CategoryModel::all();
        return view('books',[
            'books' => $book,
            'categories' => $categories
        ]);
    }

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

            $book->title = $title;
            $book->author = $author;
            $book->description = $description;
            $book->published_date = $publish;
            $book->is_available = $request->has('available') ? 1 : 0;
            $book->save();

            if (isset($_POST['category_id']) && is_array($_POST['category_id'])) {
                $book->category()->sync($_POST['category_id']);
            } else {
                $book->category()->detach();
            }

            return redirect('books');
        }
    }

    public function delete(){
        $book = BookModel::find($_POST['book_id']);

        $book->categories()->detach();
        $book->delete();

        return redirect('books')->with('success', 'Book has been deleted successfully!');
    }
}
