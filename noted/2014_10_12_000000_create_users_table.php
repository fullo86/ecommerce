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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 12)->unique()->required();
            $table->string('name', 55)->required();
            $table->string('password', 255)->required();
            $table->string('phone', 15)->required();
            $table->string('email', 55)->required();
            $table->text('address')->nullable();
            $table->string('image_profile', 255)->nullable();
            $table->string('active_status', 20)->default('active');
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
        Schema::dropIfExists('users');
    }
};
