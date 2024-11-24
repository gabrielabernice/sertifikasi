<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\LoanModel;
use App\Models\MemberModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // function to create loan
    public function create(Request $request){
        $loan_date = "";
        $return_date = "";
        $is_returned = "";

        // check whether all data has been filled
        if(isset($_POST['member_id'])){
            $member_id = $_POST['member_id'];
        }
        if (isset($_POST['books'])) {
            $books = $_POST['books'];
        } else {
            return redirect()->back()->with('error', 'No books selected!');
        }
        if(isset($_POST['loan_date'])){
            $loan_date = $_POST['loan_date'];
        }
        if(isset($_POST['return_date'])){
            $return_date = $_POST['return_date'];
        }
        if(isset($_POST['is_returned'])){
            $is_returned = $_POST['is_returned'];
        }

        // validate if memebr exists
        $member = MemberModel::find($member_id);
        if (!$member) {
            die('Invalid member ID');
        }

        // validate if the books are available
        $books = BookModel::whereIn('id', $books)->where('is_available', 1)->get();

        // check if all the selected books are available
        if ($books->count() !== count($books)) {
            // if not available
            return redirect()->back()->with('error', 'One or more selected books are not available!');
        }

        // create the new loan data
        foreach ($books as $book) {
            $loan = new LoanModel();
            $loan->member_id = $member_id;
            $loan->book_id = $book->id;
            $loan->loan_date = now();
            $loan->return_date = null;
            $loan->is_returned = $request->has('returned') ? 1 : 0;
            $loan->save();

            // update the book availability to "not available"
            $book->is_available = 0;
            $book->save();
        }

        return redirect('loans')->with('success', 'Loan recorded successfully!');
    }

    // function to read the loan
    public function view(Request $request){
        // get all members and only take books that are avail
        $members = MemberModel::all();
        $books = BookModel::where('is_available', 1)->get();

        // for filter, if member_id is selected and is a GET
        if ($request->isMethod('get') && $request->has('member_id') && $request->member_id != 0) {
            $member_id = $request->input('member_id');
            $loans = LoanModel::where('member_id', $member_id)->with('book', 'member')->get();
        } else {
            $loans = LoanModel::with('book', 'member')->get();
        }

        return view('loans', compact('loans', 'members', 'books'));
    }

    // function to edit loan
    public function update(Request $request){
        $loan = LoanModel::find($request->loan_id);

        if (!isset($_POST['from_edit'])){
            return view('updateLoan',[
                'loan' => $loan
            ]);
        }else{
            if(isset($_POST['member_id'])){
                $member_id = $_POST['member_id'];
            }
            if(isset($_POST['book_id'])){
                $book_id = $_POST['book_id'];
            }
            if(isset($_POST['loan_date'])){
                $loan_date = $_POST['loan_date'];
            }
            
            // updaye the loan's is_returned status
            $loan->is_returned = isset($_POST['is_returned']) ? 1 : 0;
            $loan->return_date = now();
            $loan->save();

            // change th ebook;s avail when the book is returned
            $book = BookModel::find($loan->book_id);
            $book->is_available = $loan->is_returned;
            $book->save();            

            return redirect('loans')->with('success', 'Loan status updated successfully!');
        }
    }

    // function to delete loan
    public function delete(Request $request){
        $loan = LoanModel::find($request->loan_id);

        if (!$loan) {
            return redirect('loans')->with('error', 'Loan record not found.');
        }

        $book = BookModel::find($loan->book_id);
            if ($book) {
                $book->is_available = 1;
                $book->save();
            }

        // delete the loan
        $loan->delete();

        return redirect('loans')->with('success', 'Loan record deleted successfully!');
    }
}