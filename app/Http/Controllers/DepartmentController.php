<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = Campus::all();
        return view('department_view', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campuses = Campus::all(); // Fetch all campuses
        return view('department_registration', compact('campuses'));
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
            'department_code' => 'required|string|unique:departments,department_code',
            'department_name' => 'required|string|max:255',
            'campus_id' => 'required|exists:campuses,campus_id',
        ]);

        Department::create([
            'department_code' => $request->department_code,
            'department_name' => $request->department_name,
            'campus_id' => $request->campus_id,
        ]);

        return redirect()->route('department.create')->with('success', 'Department registered successfully!');
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
    public function edit($department_code)
    {
        $department = Department::findOrFail($department_code);
        return view('department_edit', compact('department'));
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'department_code' => 'required|string|max:10',
            'department_name' => 'required|string|max:255'
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'department_code' => $request->department_code,
            'department_name' => $request->department_name
        ]);

        return redirect()->route('department.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('department.index')->with('success', 'Department deleted successfully.');
    }


    public function getDepartments($campus_id)
    {
        $departments = Department::where('campus_id', $campus_id)->get();

        if ($departments->isEmpty()) {
            return response()->json(['message' => 'No departments found'], 404);
        }

        return response()->json($departments);
    }   



    public function searchByCampus($campus_id)
    {
        $departments = \App\Models\Department::where('campus_id', $campus_id)->get();

        return response()->json($departments);
    }   
}
