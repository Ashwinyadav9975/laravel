<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Home_model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controller;

class Home extends Controller
{
    

    // A method to get decrypted users excluding the logged-in user
    protected function Get_users()
    {
        return Home_model::Get_decrypted_users();
    }

    public function Home_data()
    {
        // Fetch the users (without repeating code)
        $users = $this->Get_users();

        // Pass the users data to the view
        return view('Home', compact('users'));
    }

    // Handle the AJAX request for DataTables
    public function fetchUsers(Request $request)
    {
        if ($request->ajax()) {
            // Fetch the users (without repeating code)
            $users = $this->Get_users();
            $auth_user = Auth::user();
            // Return the data in DataTables format

            return DataTables::of($users)
                ->addColumn('action', function ($row) use ($auth_user) {

                    if ($auth_user->user_type == 'admin') {
                        return '
                        <button class="btn btn-primary edit-btn" data-id="' . $row->id . '">Edit</button>

                        <button class="btn btn-danger" data-id="' . $row->id . '" id="delete-btn">Delete</button>
                    ';
                    } else {
                        // If not an admin, show nothing or just view actions (if any)
                        return '';
                    }
                })
                ->rawColumns(['action']) // Ensure HTML is rendered in 'action' column
                ->make(true); // Return data in the correct format for DataTables
        }

        return view('Home');
    }
    public function Delete_user($id)
    {
        // Find the user by ID
        $user = Home_model::find($id);

        // Check if user exists
        if ($user) {
            // Delete the user from the database
            $user->delete();

            // Return a success response (JSON or redirect, depending on the context)
            return response()->json(['success' => 'User deleted successfully.']);
        }

        // If user not found, return an error message
        return response()->json(['error' => 'User not found.'], 404);
    }
}
