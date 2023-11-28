<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_id', 50);
            $table->string('status_code', 5);
            $table->string('trasanction_status', 100);
            $table->string('payment_type', 50);
            $table->dateTime('transaction_time');
            $table->string('bank', 20);
            $table->string('va_number', 50);
            $table->string('pdf_url', 255);
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
};
