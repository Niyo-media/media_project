<?php
namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Models\Campus;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupervisorController extends Controller
{

    public function create()
    {
        $campuses = Campus::all();
        $departments = Department::all();
        return view('supervisor_register', compact('campuses', 'departments'));
    }



    public function index(Request $request, $department_code)
    {

        $supervisors = Supervisor::where('department_code', $department_code)->get(); // Empty initially

        if ($request->has('department_code')) {
            $supervisors = Supervisor::join('departments', 'supervisors.department_code', '=', 'departments.department_code')
                ->where('supervisors.department_code', $request->department_code)
                ->select('supervisors.*', 'departments.department_name')
                ->get();
        }

        return view('supervisor_view', compact('supervisors'));
    }


    public function store(Request $request)
    {
        Supervisor::create([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'campus_id' => $request->campus_id,
            'department_code' => $request->department_code,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/supervisors/create')->with('success', 'Supervisor registered successfully.');
    }


    public function edit()
    {
        $supervisor = Supervisor::where('email', $email)->firstOrFail();
        return view('supervisors.edit', compact('supervisor'));
    }



    public function update(Request $request, $email)
    {
        $supervisor = Supervisor::where('email', $email)->first();
        $supervisor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'campus_id' => $request->campus_id,
            'department_code' => $request->department_code,
        ]);

        return redirect()->route('supervisors.index')->with('success', 'Supervisor updated successfully!');
    }

    
    public function destroy($email)
    {
        Supervisor::where('email', $email)->delete();
        return back()->with('success', 'Supervisor deleted successfully!');
    }

    public function getDepartments($campus_id)
    {
        $departments = Department::where('campus_id', $campus_id)->get();
        return response()->json($departments);
    }
}
