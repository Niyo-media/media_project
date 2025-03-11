<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('student_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'student_reg_number' => 'required|unique:students',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required|unique:students',
            'campus_id' => 'required|exists:campuses,id',
            'department_code' => 'required|exists:departments,department_code',
            'faculty_code' => 'required|exists:faculties,faculty_code',
        ]);

        Student::create([
            'student_reg_number' => $request->student_reg_number,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'campus_id' => $request->campus_id,
            'department_code' => $request->department_code,
            'faculty_code' => $request->faculty_code,
        ]);

        return redirect()->route('student.login')->with('success', 'Registration successful. Please login.');
    }

    public function showLoginForm()
    {
        return view('student_login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'student_reg_number' => 'required',
            'password' => 'required',
        ]);

        // Check if the HOD exists
        $student = Student::where('student_reg_number', $request->student_reg_number)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return back()->with('error', 'Invalid student_reg_number or password.');
        }

        // Store HOD details in session
        session([
            'student_reg_number' => $student->student_reg_number,
            'student_name' => $student->first_name . ' ' . $student->last_name,
            'department_code' => $student->department_code,
            'faculty_code' => $student->faculty_code,
        ]);

        return redirect()->route('student.dashboard');
    }

    public function logout()
    {
        session()->forget(['student_reg_number', 'student_name']);
        return redirect()->route('student.login')->with('success', 'Logged out successfully.');
    }
}
