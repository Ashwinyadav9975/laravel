<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class Home_model extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Ensure this matches your actual database table name

    protected $fillable = ['id', 'name', 'email', 'mobile', 'gender', 'user_type']; // Define mass-assignable fields

    // Fetch all users except the currently authenticated user
    public static function Get_decrypted_users()
    {
        $currentUserId = Auth::id();  // Get the currently authenticated user's ID

        // Fetch users excluding the current user
        $users = self::select('id', 'name', 'email', 'mobile', 'gender', 'user_type')
                     ->where('id', '!=', $currentUserId)  // Exclude the current user
                     ->get();

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
