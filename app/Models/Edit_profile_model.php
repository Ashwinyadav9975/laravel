<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
class Edit_profile_model extends Model
{
    use HasFactory;

    protected $table = 'user';  // Ensure this matches your table name

    // Method to get the user by ID
    public static function getUserById($id)
    {
        // Fetch the user by ID using Eloquent
        $user = self::findOrFail($id);
    
        // Decrypt the email and mobile fields
      
        $user->email = Crypt::decrypt($user->email); 
        $user->mobile = Crypt::decrypt($user->mobile);
        return $user;
    }

    // Method to update the user
    public static function updateUser($id, $data)
    {
        $user = self::findOrFail($id);

        if ($user) {
            // Decrypt the email and mobile before saving (if you need encryption)
        
            $user->mobile = Crypt::encrypt($data['mobile']);
            $user->name = $data['name'];
            $user->gender = $data['gender'];
            $user['updated_at'] = now()->timestamp; 

            // Save the updated user data
            return $user->save();
        }

        return false;
    }   //
}
