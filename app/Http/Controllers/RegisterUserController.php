<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function showRegistrationForm()
    {
        return Inertia('Auth/Register');
    }

    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'], // hashed by mutator
        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->route('listings.index');
    }
}
