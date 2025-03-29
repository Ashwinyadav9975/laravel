<?php
namespace App\Http\Controllers;

use App\Models\Login_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Login extends Controller
{
    private $login;

    public function __construct(Login_model $login)
    {
        $this->login = $login;
    }

    // Show the login page
    public function Show_login_form()
    {
        return view('login');
    }

    // Handle user login
    public function login_user(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $key = 'password_attempts_' . Str::lower($request->email) . '|' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $attempts = RateLimiter::attempts($key);
            return response()->json([
                'status' => 'error',
                'message' =>  "Too many incorrect password attempts ($attempts/3). Try again in $seconds seconds."
            ]);
        }

        // Find user by email and decrypt the stored email
        $user = $this->login::all()->first(function ($user) use ($request) {
            try {
                // Decrypt the email and compare it
                return Crypt::decrypt($user->email) === $request->email;
            } catch (DecryptException $e) {
                // Handle decryption failure and log the error
                return false;
            }
        });

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'No account found!'
            ]);
        }

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            RateLimiter::hit($key, 60);
            $attempts = RateLimiter::attempts($key); // Get updated attempt count
            return response()->json([
                'status' => 'error',
                'message' => "Incorrect password! ($attempts/3 attempts)"
            ]);
        }

        // Reset failed attempts after successful login
        RateLimiter::clear($key);

        // Authenticate the user
        Auth::login($user);
        $user = Auth::user();

        // Redirect to dashboard after successful login
        return response()->json([
            'status' => 'success',
            'message' => 'Welcome!',
            'redirect' => route('home')
        ]);
    }

    // Logout function
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
