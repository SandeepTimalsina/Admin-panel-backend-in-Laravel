<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Get users by role
    public function getUsersByRole($role)
    {
        $users = User::where('role', $role)->get();
        return response()->json($users);
    }

    // Create a new user
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,staff,user',
            'status' => 'required|boolean'
             // Validate role
        ]);
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
            'status'=> $validatedData['status'],
        ]);
    
        // Return a success response
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201); // HTTP 201 Created
    }
    

    // Update user role
    public function updateRole(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role' => 'required|in:admin,staff,user',
        ]);

        $user = User::findOrFail($id);
        $user->role = $validatedData['role'];
        $user->save();

        return response()->json($user);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

