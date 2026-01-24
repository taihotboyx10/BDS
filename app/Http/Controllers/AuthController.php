<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function dspLoginForm()
    {
        return inertia('Auth/Login');
    }

    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        $result = Auth::attempt($user, true);
        if (!$result) {
            throw ValidationException::withMessages([
                'password' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('listings.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listings.index');
    }

    public function showVerifyEmailNotice()
    {
        return Inertia('Auth/VerifyEmail');
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('listings.index');
        }

        if ($request->user()->markEmailAsVerified()) {
            //
        }

        return redirect()->route('listings.index')->with('success', 'Email verified successfully!');
    }

    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('listings.index');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent,please check your email!');
    }
}
