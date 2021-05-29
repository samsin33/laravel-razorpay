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
        Schema::connection(config('razorpay.db_connection'))->create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plan_id')->unsigned()->unique()->nullable();
            $table->string('razorpay_subscription_id', 100)->nullable()->unique();
            $table->string('razorpay_plan_id', 100)->nullable()->unique();
            $table->integer('total_count')->nullable();
            $table->integer('customer_notify')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('start_at')->nullable()->unsigned();
            $table->integer('expired_by')->nullable()->unsigned();
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
        Schema::connection(config('razorpay.db_connection'))->drop('subscriptions');
    }
}