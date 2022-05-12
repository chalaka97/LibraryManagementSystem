<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinedDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fined_details', function (Blueprint $table) {
            $table->id();
            $table->integer('f_user_id');
            $table->foreign('f_user_id')->references('id')->on('library_users')->onDelete('cascade');
            $table->integer('f_b_book_id');
            $table->foreign('f_b_book_id')->references('id')->on('borrow_books')->onDelete('cascade');
            $table->integer('f_days'); //total days count
            $table->double('f_total_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fined_details');
    }
}
