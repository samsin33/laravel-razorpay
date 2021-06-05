<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzpOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('razorpay.db_connection'))->create('rzp_order_payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 120)->nullable();
            $table->string('rzp_payment_id', 120)->nullable();
            $table->string('rzp_signature')->nullable();
            $table->string('status', 120)->nullable();
            $table->text('data')->nullable();
            $table->ipAddress('ipaddress')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('razorpay.db_connection'))->drop('rzp_order_payments');
    }
}