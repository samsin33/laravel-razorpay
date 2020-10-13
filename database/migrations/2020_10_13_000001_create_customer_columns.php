<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $model = config('razorpay.model');
        $table = (new $model)->getTable();
        Schema::connection(config('razorpay.db_connection'))->table($table, function (Blueprint $table) {
            $table->string('razorpay_id')->nullable()->index();
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {}
}