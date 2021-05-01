<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10);
            $table->integer('total');
            $table->integer('courier_cost');
            $table->tinyInteger('status');
            $table->string('payment_receipt')->nullable();

            $table->foreignId('order_id')->constrained('orders')->onDelete('restrict');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');

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
        Schema::dropIfExists('transactions');
    }
}
