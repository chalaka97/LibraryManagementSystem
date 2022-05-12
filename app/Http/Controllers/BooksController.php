<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
   public function index(){
       return view('library_books');
   }
   public function addBook(Request $request){
       $request->validate([
           'bookname' => 'required|max:190',
           'bookauthor' => 'required|max:190',
           'booktype' => 'required|max:60',

       ]);
       $Book = new Books();
       $Book->b_title = $request->bookname;
       $Book->b_author = $request->bookauthor;
       $Book->b_type = $request->booktype;


       if ($Book->save()) {
           return redirect()->back()->with('success_book', 'User Added Successfully');
       } else {
           return redirect()->back()->with('error_book', 'Can not Add User');
       }
   }
}
