<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryUsersController extends Controller
{
    public function index(){
        return view('library_users');
    }
}
