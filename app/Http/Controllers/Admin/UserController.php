<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $users = User::all();
        return view('Posts.admin.users', compact('users'));  
    }

    // Show the form for creating a new user
    public function create()
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        return view('Posts.admin.users.create');  
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'admin' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'admin' => $request->admin,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        return view('Posts.admin.users.edit', compact('user'));
    }

    // Update the specified user in the database
    public function update(Request $request, User $user)
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'admin' => 'required|boolean',
        ]);

        // Update the user's information, excluding the email field
        $user->update([
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'admin' => $request->admin,
        ]);

        // Redirect back to the users index with a success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    
    // Remove the specified user from the database
    public function destroy(User $user)
    {
        // Ensure the user is an admin
        if (!Auth::user()->admin) {
            abort(403, 'Unauthorized access.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
