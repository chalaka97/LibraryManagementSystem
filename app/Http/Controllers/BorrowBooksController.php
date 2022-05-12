<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\BorrowBooks;
use App\Models\LibraryUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowBooksController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $users = LibraryUsers::all();
        $books = Books::all();

        return view('home', ['allusers' => $users, 'allbooks' => $books]);
    }

    public function borrowedBook()
    {
        // id	user_id	book_id	borrow_date	is_overdue	received_date
        $borrowedList = DB::table('borrow_books')
            ->join('library_users', 'library_users.id', '=', 'borrow_books.user_id')
            ->join('books', 'books.id', '=', 'borrow_books.book_id')
            ->where('received_date', null)
            ->select('borrow_books.*', 'books.b_title', 'books.b_type', 'library_users.u_name')
            ->get();
        return view('borrowed_books', ['borrowedBooks' => $borrowedList]); //not received
    }

    public function checkAvailability(Request $request)
    {
        $checkAvailablity = DB::table('borrow_books')->join('library_users','library_users.id', '=' ,'borrow_books.user_id')
            ->join('books','books.id','=','borrow_books.book_id')
            ->where('borrow_books.user_id',$request->id)
            ->where('borrow_books.b_book_type',$request->b_book_type)->get();


        /*$checkAvailablity = DB::select("SELECT * FROM `borrow_books`,`library_users`,`books` where library_users.id = borrow_books.user_id
        AND books.id=borrow_books.book_id and borrow_books.user_id=" . $request->id . " AND borrow_books.b_book_type =" . $request->b_book_type);*/


        /*dd($checkAvailablity);*/
    }
}
