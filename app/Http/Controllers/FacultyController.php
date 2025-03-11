<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Campus;


class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campuses = Campus::all();
        $departments = Department::all();
        return view('faculty_registration', compact('campuses', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'faculty_code' => 'required|string|unique:faculties,faculty_code',
            'faculty_name' => 'required|string',
            'department_code' => 'required|string|exists:departments,department_code',
        ]);

        Faculty::create([
            'faculty_code' => $request->faculty_code,
            'faculty_name' => $request->faculty_name,
            'department_code' => $request->department_code,
        ]);

        return redirect('/faculties/create')->with('success', 'Faculty registered successfully.');
    }

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
    public function edit(Request $request, Faculty $faculty)
    {
        return view('faculty_edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $faculity_code)
    {   

        $faculty = Faculty::findOrFail($faculity_code);
        $faculty->update([
            'faculty_code' => $request->faculty_code,
            'faculty_name' => $request->faculty_name
        ]);

        return redirect()->route('faculties.index')->with('success', 'Faculty updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($faculty_code)
    {
        $faculty = Faculty::findOrFail($faculty_code);
        $faculty->delete();

        return redirect()->route('faculties.index')->with('success', 'Faculty deleted successfully.');
    }



    public function getDepartments($campus_id)
    {
        $departments = Department::where('campus_id', $campus_id)->get();
        return response()->json($departments);
    }


    public function index(Request $request)
    {
        $campuses = Campus::all();
        $departments = [];

        $faculties = []; // Empty initially

        if ($request->has('campus_id')) {
            $departments = Department::where('campus_id', $request->campus_id)->get();
        }

        if ($request->has('department_code')) {
            $faculties = Faculty::join('departments', 'faculties.department_code', '=', 'departments.department_code')
                ->where('faculties.department_code', $request->department_code)
                ->select('faculties.*', 'departments.department_name')
                ->get();
        }

        return view('faculty_view', compact('campuses', 'departments', 'faculties'));
    }
}
