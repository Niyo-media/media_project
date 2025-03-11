<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Supervisor;

class SupervisorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('supervisor_login'); // Ensure this view exists
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if the HOD exists
        $supervisor = Supervisor::where('email', $request->email)->first();

        if (!$supervisor || !Hash::check($request->password, $supervisor->password)) {
            return back()->with('error', 'Invalid email or password.');
        }

        // Store HOD details in session
        session([
            'supervisor_email' => $supervisor->email,
            'supervisor_name' => $supervisor->first_name . ' ' . $supervisor->last_name
        ]);

        return redirect()->route('supervisor.dashboard');
    }

    public function logout()
    {
        session()->forget(['supervisor_email', 'supervisor_name']);
        return redirect()->route('supervisor.login')->with('success', 'Logged out successfully.');
    }
}
