<?php

namespace App\Http\Controllers;

use App\Models\BorrowBooks;
use App\Models\FinedDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Console\Scheduling\Schedule;
class FinedDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('fined_details');
    }
    
    protected function finedDetailsUpdate(Schedule $schedule)
    {
        $schedule->call(function  () {
            $getNotReceivedDetails = DB::select("SELECT borrow_books.id as borrowed_id, books.id as book_id,books.b_type,library_users.id as user_id,library_users.u_type,borrow_books.borrow_date,DATEDIFF(now(),borrow_books.borrow_date) as dayscount FROM borrow_books,books,library_users WHERE borrow_books.user_id = library_users.id AND borrow_books.book_id = books.id AND borrow_books.received_date is null");

            for ($i = 0; $i < count($getNotReceivedDetails); $i++) {


                $borrowedID = $getNotReceivedDetails[$i]->borrowed_id;
                $userID = $getNotReceivedDetails[$i]->user_id;
                $bookID = $getNotReceivedDetails[$i]->book_id;
                $daysCount = $getNotReceivedDetails[$i]->dayscount;

                if ($getNotReceivedDetails[$i]->b_type == "Lending") {
                    if ($getNotReceivedDetails[$i]->u_type == "Student") {
                        //14 days
                        if ($daysCount > 14) {
                            $fee = $daysCount * 10.00;
                            $this->updateBorrowAndFinedTables($borrowedID, $userID, $bookID, $daysCount, $fee);
                        }

                    } elseif ($getNotReceivedDetails[$i]->u_type == "Faculty member") {
                        //30days
                        if ($daysCount > 30) {
                            $fee = $daysCount * 20.00;
                            $this->updateBorrowAndFinedTables($borrowedID, $userID, $bookID, $daysCount, $fee);
                        }
                    }

                } elseif ($getNotReceivedDetails[$i]->b_type == "Reference") {
                    if ($getNotReceivedDetails[$i]->u_type == "Student") {
                        //1 day
                        if ($daysCount > 0) {
                            $fee = $daysCount * 50.00;
                            $this->updateBorrowAndFinedTables($borrowedID, $userID, $bookID, $daysCount, $fee);
                        }
                    } elseif ($getNotReceivedDetails[$i]->u_type == "Faculty member") {
                        //3 days
                        if ($daysCount > 3) {
                            $fee = $daysCount * 80.00;
                            $this->updateBorrowAndFinedTables($borrowedID, $userID, $bookID, $daysCount, $fee);
                        }
                    }
                }
            }

        })->daily();
    }
    public function updateBorrowAndFinedTables($borrowID, $userID, $bookID, $days, $fee)
    {
        $updateBorrow = [
            'is_overdue' => 1,
        ];
        $finedTable = new FinedDetails();
        $finedTable->f_user_id = $userID;
        $finedTable->f_b_book_id = $borrowID;
        $finedTable->f_days = $days;
        $finedTable->f_total_payment = $fee;

        if (BorrowBooks::where('id', $borrowID)->update($updateBorrow) && $finedTable->save()) {
            echo "added";
        } else {
            echo "error";
        }

    }
}
