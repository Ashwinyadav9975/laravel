<?php

namespace App\Http\Controllers;

use App\Models\Edit_user_model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Edit_user extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the edit user form
    public function edit($id)
    {
        // Get user data using the custom model method
        $user = Edit_user_model::getUserById($id);

        // Check if the authenticated user is allowed to edit this user
        if (Auth::user()->id != $user->id && Auth::user()->user_type !== 'admin') {
            return redirect()->route('home')->with('error', 'You are not authorized to edit this user');
        }

        return view('Edit_user', compact('user'));
    }

    // Update the user data
    public function update_user(Request $request, $id)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:10',  // Add validation for mobile number
            'gender' => 'required|in:male,female', // Validate gender
        ]);
    
        // Attempt to update user data
        $result = Edit_user_model::updateUser($id, $request->all());
    
        if ($result) {
            // Return a success response for AJAX
            return response()->json(['status' => 'success', 'message' => 'User updated successfully', 'redirect' => route('home')]);
        } else {
            // Return an error response for AJAX
            return response()->json(['status' => 'error', 'message' => 'Failed to update user.']);
        }
    }
    
}
