<?php

namespace App\Http\Controllers;

use App\Mail\FinedDetailsMail;
use App\Models\BorrowBooks;
use App\Models\FinedDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

        $fined = DB::select("SELECT fined_details.id as id, fined_details.f_b_book_id
        as b_id,library_users.u_name, books.b_title,books.b_type, fined_details.f_days, fined_details.f_total_payment
        FROM fined_details,books,library_users,borrow_books WHERE fined_details.f_user_id = library_users.id
        AND fined_details.f_b_book_id = borrow_books.id AND borrow_books.book_id = books.id AND fined_details.is_received=0;");

        return view('fined_details',['fined'=>$fined]);
    }

    protected function finedDetailsUpdate(Schedule $schedule)
    {
        $schedule->call(function () {
            $getNotReceivedDetails = DB::select("SELECT borrow_books.id as borrowed_id, books.id as
            book_id,books.b_type,library_users.id as user_id,library_users.u_type,borrow_books.borrow_date,
            DATEDIFF(now(),borrow_books.borrow_date) as dayscount FROM borrow_books,books,library_users
            WHERE borrow_books.user_id = library_users.id AND borrow_books.book_id = books.id
            AND borrow_books.received_date is null");

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
            /*echo "added";*/
        } else {
            /*echo "error";*/
        }

    }
    protected function sendMain(Schedule $schedule)
    {

        $schedule->call(function () {
            $finedDetails = DB::select("SELECT books.b_title as book_name,books.b_type as book_type,library_users.u_name
        as user_name, library_users.u_email as email, library_users.u_type ,borrow_books.borrow_date, fined_details.f_days
        as days, fined_details.f_total_payment as payment
        from borrow_books,books,library_users,fined_details
        WHERE fined_details.f_user_id = library_users.id
        AND fined_details.f_b_book_id = borrow_books.id AND books.id=borrow_books.book_id");


            for ($i = 0; $i < count($finedDetails); $i++) {

                Mail::to($finedDetails[$i]->email)->send(new FinedDetailsMail($finedDetails));
            }
        })->cron('0 */2 * * *');

    }
}
