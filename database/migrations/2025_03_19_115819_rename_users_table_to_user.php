<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile');
            $table->string('gender');
            $table->enum('user_type', ['admin', 'user']);
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}

