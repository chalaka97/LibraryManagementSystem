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
        /* dd($borrowedList);*/
        return view('borrowed_books', ['borrowedBooks' => $borrowedList]); //not received
    }

    public function checkAvailability(Request $request)
    {
        $bookTypeId = $request->selected_book;
        $check = DB::select("select b_book_type as btype, library_users.u_type as utype, count(borrow_books.id) as count  from borrow_books , books, library_users where borrow_books.book_id = books.id AND borrow_books.user_id =library_users.id AND borrow_books.book_id = $bookTypeId and borrow_books.b_book_type = books.b_type AND borrow_books.user_id = $request->user_id  and received_date is null");
        /*select count(borrow_books.id) as count from borrow_books , books where borrow_books.book_id = books.id AND borrow_books.book_id = 1 and borrow_books.b_book_type = books.b_type AND borrow_books.user_id = 2 and received_date is null*/
        /*echo $check[0]->btype;
        echo $check[0]->utype;
        echo $check[0]->count;*/
        /*
         * student - ref - 2
         * student - len - 3
         * faulty - ref - 4
         * faulty - len - 6
         * */
        if ($check[0]->count > 0) {
            if ($check[0]->btype == "Lending") {
                if ($check[0]->utype == "Faculty member") {
                    if ($check[0]->count < 6) {
                       // echo "lending faculty can borrow";
                        if($this->addBook($request,"Lending")){
                            return redirect()->back()->with('success_book', 'Successfully Borrowed a Lending Book');
                        }
                        else{
                            return redirect()->back()->with('error_book', 'Can not borrow a Lending book');
                        }

                    } else {
                        //echo "lending faculty can't borrow";
                        //code here
                        return redirect()->back()->with('error_book', 'Can not borrow a book Note: Borrowed 6 Lending books');
                    }
                } elseif ($check[0]->utype == "Student") {
                    if ($check[0]->count < 3) {
                        //echo "lending student can borrow";
                        if($this->addBook($request,"Lending")){
                            return redirect()->back()->with('success_book', 'Successfully Borrowed a Lending Book');
                        }
                        else{
                            return redirect()->back()->with('error_book', 'Can not borrow a Lending book');
                        }

                    } else {
                        //echo "lending student can't borrow";
                        return redirect()->back()->with('error_book', 'Can not borrow a book Note: Borrowed 3 Lending books');
                    }
                } else {
                    return redirect()->back()->with('error_book', 'Can not borrow a book Note: Error Lending books');
                }

            } elseif ($check[0]->btype == "Reference") {
                if ($check[0]->utype == "Faculty member") {
                    if ($check[0]->count < 4) {
                        //echo "Reference faculty can borrow";
                        if($this->addBook($request,"Reference")){
                            return redirect()->back()->with('success_book', 'Successfully Borrowed a Reference Book');
                        }
                        else{
                            return redirect()->back()->with('error_book', 'Can not borrow a Reference book');
                        }

                    } else {
                        //echo "Reference faculty can't borrow";
                        return redirect()->back()->with('error_book', 'Can not borrow a book Note: Borrowed 4 Reference books');
                    }

                } elseif ($check[0]->utype == "Student") {
                    if ($check[0]->count < 2) {
                        //echo "Reference student can borrow";
                        if($this->addBook($request,"Reference")){
                            return redirect()->back()->with('success_book', 'Successfully Borrowed a Reference Book');
                        }
                        else{
                            return redirect()->back()->with('error_book', 'Can not borrow a Reference book');
                        }

                    } else {
                        //echo "Reference student can't borrow";
                        return redirect()->back()->with('error_book', 'Can not borrow a book Note: Borrowed 2 Reference books');
                    }

                }

            } else {
                return redirect()->back()->with('error_book', 'Can not borrow a book Note: Error Reference books');
            }
        }
        else{
            /*can add*/
            //echo "did not borrowed any book can borrow";

            $booktype=DB::select("SELECT b_type FROM books WHERE id=$bookTypeId");
            /*dd($booktype[0]->b_type);*/
            $bookval = $booktype[0]->b_type;
            if($this->addBook($request,$bookval)){
                return redirect()->back()->with('success_book', "Successfully Borrowed a $bookval Book");
            }else{
                return redirect()->back()->with('error_book', "Can not borrow a $bookval book..");
            }
        }


    }
    public function addBook(Request $request, string $booktype){
        $request->validate([
            'user_id' => 'required',
            'selected_book' => 'required',

        ]);
        $addBorrow = new BorrowBooks();
        $addBorrow->user_id = $request->user_id;
        $addBorrow->book_id = $request->selected_book;
        $addBorrow->b_book_type = $booktype;
        $addBorrow->borrow_date = now();

        return $addBorrow->save();
    }
}
