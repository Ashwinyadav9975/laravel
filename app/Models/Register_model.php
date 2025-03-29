<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class Register_model extends Model
{
    use HasFactory;

    protected $table = 'user'; // Table name

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'gender',
        'user_type'
    ];

    public $timestamps = true;

    public function insert_user($data)
    {

        $data['password'] = Hash::make($data['password']);
        $data['email'] = Crypt::encrypt($data['email']);
        $data['mobile'] = Crypt::encrypt($data['mobile']);
        $data['created_at'] = now()->timestamp; // Manually set created_at
        // return db::table($this->table)->insertGetId($data);
        return DB::table($this->table)->insertGetId($data);
    }
}
