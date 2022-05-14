<?php

namespace App\Http\Controllers;

use App\Models\LibraryUsers;
use Illuminate\Http\Request;

class LibraryUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('library_users');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'username' => 'required|max:190',
            'useremail' => 'required','string', 'email', 'max:255', 'unique:library_users',
            'usercontact' => 'required','numeric','digits:10',
            'usertype' => 'required|max:60',
        ]);
        $User = new LibraryUsers();
        $User->u_name = $request->username;
        $User->u_email = $request->useremail;
        $User->u_type = $request->usertype;


        if ($User->save()) {
            return redirect()->back()->with('success_user', 'User Added Successfully');
        } else {
            return redirect()->back()->with('error_user', 'Can not Add User');
        }
    }
}
