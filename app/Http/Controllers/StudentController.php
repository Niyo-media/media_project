<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Campus;
use App\Models\Department;
use App\Models\Faculty;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $department_code)
    {
        $students = Student::where('department_code', $department_code)->get(); // Empty initially

        if ($request->has('department_code')) {
            $students = Student::join('departments', 'students.department_code', '=', 'departments.department_code')
                ->where('students.department_code', $request->department_code)
                ->select('students.*', 'departments.department_name')
                ->get();
        }

        return view('student_view', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campuses = Campus::all();
        $departments = Department::all();
        $faculties = Faculty::all();
        return view('student_register', compact('campuses', 'departments','faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request) {
    
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
    
        return redirect('/students/create')->with('success', 'Student registered successfully.');
    }
    
    
    // public function store(Request $request)
    // {
    //     Student::create([
    //         'student_reg_number' => $request->student_reg_number,
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'gender' => $request->gender,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'phone_number' => $request->phone_number,
    //         'campus_id' => $request->campus_id,
    //         'department_code' => $request->department_code,
    //         'faculty_code' => $request->faculty_code,
    //     ]);
    //     return redirect('/students/create')->with('success', 'student registered successfully.');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $students = Student::where('email', $email)->firstOrFail();
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        $supervisor = Student::where('email', $email)->first();
        $supervisor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'campus_id' => $request->campus_id,
            'department_code' => $request->department_code,
        ]);

        return redirect()->route('students.index')->with('success', 'Students updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_reg_number)
    {
        Student::where('student_reg_number', $student_reg_number)->delete();
        return back()->with('success', 'Student deleted successfully!');
    }

    public function getDepartments($campus_id)
    {
        $departments = Department::where('campus_id', $campus_id)->get();
        return response()->json($departments);
    }

    public function getFaculties($departmentCode)
    {
        $faculties = Faculty::where('department_code', $departmentCode)->get();
        return response()->json($faculties);
    }

}
