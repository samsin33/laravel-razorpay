<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_plan_id', 100)->nullable()->unique();
            $table->string('name')->nullable();
            $table->integer('amount')->nullable()->unsigned();
            $table->string('currency')->nullable();
            $table->string('period', 100)->nullable();
            $table->integer('interval')->nullable();
            $table->string('entity')->nullable();
            $table->text('description')->nullable();
            $table->text('request')->nullable();
            $table->text('response')->nullable();
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
        Schema::drop('plans');
    }
}