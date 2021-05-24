<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderColumns extends Migration
{
    private $table;

    public function __construct()
    {
        $model = config('razorpay.order_model');
        $this->table = (new $model)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('razorpay.db_connection'))->table($this->table, function (Blueprint $table) {
            $table->string('razorpay_order_id')->nullable()->index();
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('razorpay.db_connection'))->table($this->table, function (Blueprint $table) {
            $table->dropColumn([
                'razorpay_order_id',
            ]);
        });
    }
}