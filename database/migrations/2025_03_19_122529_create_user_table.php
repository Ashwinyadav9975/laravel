<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the 'user' table
        Schema::create('user', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // User's name
            $table->string('email')->unique(); // Unique email address
            $table->string('password'); // Password
            $table->string('mobile', 10)->unique(); // Mobile number
            $table->enum('gender', ['Male', 'Female', 'Other']); // Gender (enum type)
            $table->enum('user_type', ['admin', 'user']); // User type (admin or user)
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the 'user' table if rolling back
        Schema::dropIfExists('user');
    }
}
