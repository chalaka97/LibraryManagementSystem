<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\BorrowBooksController::class, 'index'])->name('home');
Route::get('/borrowed', [App\Http\Controllers\BorrowBooksController::class, 'borrowedBook'])->name('borrowed');
Route::post('/checkadd', [App\Http\Controllers\BorrowBooksController::class, 'checkAvailability'])->name('checkadd');


Route::get('/fined-details', [App\Http\Controllers\FinedDetailsController::class, 'index'])->name('fined-details');
Route::get('/fineddetails', [App\Http\Controllers\FinedDetailsController::class, 'finedDetailsUpdate'])->name('fineddetails');


Route::get('/users', [App\Http\Controllers\LibraryUsersController::class, 'index'])->name('users');
Route::post('/addlibraryuser',[App\Http\Controllers\LibraryUsersController::class,'addUser'])->name('addlibraryuser');

Route::get('/books', [App\Http\Controllers\BooksController::class, 'index'])->name('books');
Route::post('/addbook', [App\Http\Controllers\BooksController::class, 'addBook'])->name('addbook');

