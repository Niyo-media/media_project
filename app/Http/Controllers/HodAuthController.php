<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Hod;

class HodAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('hod_login'); // Ensure this view exists
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if the HOD exists
        $hod = Hod::where('email', $request->email)->first();

        if (!$hod || !Hash::check($request->password, $hod->password)) {
            return back()->with('error', 'Invalid email or password.');
        }

        // Store HOD details in session
        session([
            'hod_email' => $hod->email,
            'hod_name' => $hod->first_name . ' ' . $hod->last_name,
            'department_code' => $hod->department_code
        ]);

        return redirect()->route('hod.dashboard');
    }

    public function logout()
    {
        session()->forget(['hod_email', 'hod_name']);
        return redirect()->route('hod.login')->with('success', 'Logged out successfully.');
    }
}
