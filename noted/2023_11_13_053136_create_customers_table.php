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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 12)->unique()->required();
            $table->string('name', 55)->required();
            $table->string('password', 255)->required();
            $table->string('phone', 15)->required();
            $table->string('email', 55)->required();
            $table->text('address')->nullable();
            $table->string('image_profile', 255)->nullable();
            $table->string('active_status', 20)->default('inactive');
            $table->string('slug', 100)->nullable();
            $table->string('province_id', 10)->nullable();
            $table->string('city_id', 10)->nullable();
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
        Schema::dropIfExists('customers');
    }
};
