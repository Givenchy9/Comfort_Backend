<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('birthdate')->nullable(); // Validate age in the application logic
            $table->string('phone')->nullable(); // Optional for regular users, required for house uploaders
            $table->string('address')->nullable(); // Optional for regular users
            $table->string('preferred_location')->nullable(); // Optional
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps(); // Includes created_at and updated_at columns
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
}