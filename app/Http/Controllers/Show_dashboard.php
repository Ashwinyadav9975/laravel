<?php

namespace App\Http\Controllers;

use App\Models\Dashboard_model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Show_dashboard extends Controller
{
    
    public function Dashboard()
    {
        return view('show_dashboard');
    }

    // Handle the AJAX request for DataTables
    public function home_user(Request $request)
    {
        if ($request->ajax()) {
            // Fetch decrypted user data via the model
            $users = Dashboard_model::getDecryptedUsers();

            // Return the data in DataTables format
            return DataTables::of($users)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-info edit" data-id="' . $row->id . '">Edit</button>';
                })
                ->rawColumns(['action']) // Ensure HTML is rendered in 'action' column
                ->make(true); // Return data in the correct format for DataTables
        }

        return view('home');
    }
}
