<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class Dashboard_model extends Model
{
   
    use HasFactory, Notifiable;

    protected $table = 'user'; // Ensure this matches your actual database table name

    protected $fillable = ['id', 'name', 'email','mobile', 'gender', 'user_type']; // Define mass-assignable fields

    public static function getDecryptedUsers()
    {
       
        $users = self::select('id', 'name', 'email', 'mobile', 'gender', 'user_type')->get();

        // Decrypt the email and mobile fields
        foreach ($users as $user) {
            try {
                $user->email = Crypt::decrypt($user->email); 
                $user->mobile = Crypt::decrypt($user->mobile);
            } catch (DecryptException $e) {
                // If decryption fails, handle the error 
                $user->email = 'Decryption error';  
                $user->mobile = 'Decryption error';  
            }
        }

        return $users;
    }
}
