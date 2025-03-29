<?php

namespace App\Http\Controllers;

use App\Models\Edit_profile_model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class Edit_profile extends Controller
{
    // Show the edit user form
    public function  editProfile($id)
    {
        // Get user data using the custom model method
        $user = Edit_profile_model::getUserById($id);

        // Check if the authenticated user is allowed to edit this user
        if (Auth::user()->id != $user->id && Auth::user()->user_type !== 'admin') {
            return redirect()->route('home')->with('error', 'You are not authorized to edit this user');
        }

        return view('edit_profile', compact('user'));
    } 

    // Update the user data
  
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validating the image file (optional)
        ]);
    
        // Get the user record by ID
        $user = Edit_profile_model::find($id);
    
        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            // Generate a unique name for the image
            $imageName = time() . '.' . $request->image->extension();
    
            // Store the image in the public folder (you can change the folder if needed)
            $request->image->move(public_path('images'), $imageName);
    
            // Store the image path in the database
            $user->image = 'images/' . $imageName; // Store the relative path in the database
        }
    
        // Update other user data
        $user->name = $request->name;
        $user->gender = $request->gender;
    
        // Save the updated user record
        $result = $user->save();
    
        // Return a response to indicate success or failure
        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully',
                'redirect' => route('home')
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update user']);
        }
    }
    

}
