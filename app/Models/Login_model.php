<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Correct use of Authenticatable
use Illuminate\Notifications\Notifiable;

class Login_model extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Ensure this matches your actual database table name

    protected $fillable = ['name', 'email', 'password','mobile','user_type,','gender']; // Define mass-assignable fields


}
