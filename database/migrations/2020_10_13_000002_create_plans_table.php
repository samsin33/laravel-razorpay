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
            $table->string('entity');
            $table->string('period', 100);
            $table->integer('interval');
            $table->text('request');
            $table->text('response');
            $table->ipAddress('ipaddress');
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