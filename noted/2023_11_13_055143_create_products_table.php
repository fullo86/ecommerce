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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('product_code', 12)->unique()->required();
            $table->string('product_name', 100)->required();
            $table->string('price', 15)->required();
            $table->text('description')->nullable();
            $table->string('stock', 5)->required();
            $table->string('status_product', 20)->default('in stock');
            $table->string('image_product1', 255)->nullable();
            $table->string('image_product2', 255)->nullable();
            $table->string('image_product3', 255)->nullable();
            $table->string('slug', 100)->nullable();
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
        Schema::dropIfExists('products');
    }
};
