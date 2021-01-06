<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plan_id')->unsigned()->unique()->nullable();
            $table->string('razorpay_subscription_id', 100)->nullable()->unique();
            $table->string('razorpay_plan_id', 100)->nullable()->unique();
            $table->integer('total_count');
            $table->integer('customer_notify');
            $table->integer('quantity');
            $table->string('start_at', 100);
            $table->string('expired_by', 100);
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