<?php

namespace App\Http\Controllers;


use App\Models\Register_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;


class Register extends Controller
{
    private $user;

    public function __construct(Register_model $user)
    {
        $this->user = $user;
    }


    public function show_registration_form()
    {
        return view('register');
    }


    public function register_user(Request $request,Register_model $user)
    {
       
        Log::info('Received AJAX request', $request->all());
        if (!$request->ajax()) return redirect()->route('register');
        $validator = Validator::make($request->all(), [
            'name'     => 'required|min:3|max:20',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|min:6|max:12',
            'mobile'   => 'required|numeric|digits:10',
            'gender'   => 'required|in:Male,Female,Other',
            'user_type' => 'required|in:user,admin',
        ]);
        
        $email = [];
        $users = $user::all(); // fetch all data from data base
        foreach ($users as $u) {  
            $email[] = Crypt::decrypt($u->email);  // implement decrypted email in array
        }
        if (in_array($request->email, $email)) {
          return  response()->json(['status' => 'error', 'message' => 'Email is already present']);
        }
        
        return $validator->fails()
            ? response()->json(['status' => 'error', 'message' => $this->message($validator->errors()->first())])
            : $this->save_user($request);
    }


    private function save_user($request)
    {
        $this->user->insert_user($request->only(['name', 'email', 'password', 'mobile', 'gender', 'user_type']));

        return response()->json(['status' => 'success', 'message' => 'User registered successfully!']);
        
    }


    private function message($error)
    {
        return [
            'The name field is required.'        => 'Please enter your name!',
            'The email field is required.'       => 'Please provide an email address!',
            'The email has already been taken.'  => 'This email is already registered. Try another one!',
            'The password field is required.'    => 'A strong password is required!',
            'The mobile field is required.'      => 'Please enter your 10-digit mobile number!',
            'The mobile must be 10 digits.'      => 'Mobile number must be exactly 10 digits!',
            'The gender field is required.'      => 'Please select your gender!',
            'The user type field is required.'   => 'You must select a user type (User/Admin)!',
        ][$error] ?? $error;
    }
 
}
