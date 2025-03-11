<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Supervisor;
use App\Models\Campus;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Faculty;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $campuses = Campus::all();
        $departments = Department::all();

        $projects = Project::query(); // Start query builder

        if ($request->filled('department_code')) {
            $projects->where('department_code', $request->department_code);
        }

        $projects = $projects->get(); // Execute query

        return view('projects', compact('projects', 'campuses', 'departments'));
    }

    public function assign(Request $request)
    {
        $campuses = Campus::all();
        $departments = Department::all();

        $projects = Project::query(); // Start query builder

        if ($request->filled('department_code')) {
            $projects->where('department_code', $request->department_code);
        }

        $projects = $projects->get(); // Execute query

        return view('assign', compact('projects', 'campuses', 'departments'));
    }

    public function proposal($student_reg_number)
    {
        $campuses = Campus::all();
        $departments = Department::all();

        $projects = Project::query(); // Start query builder

        $projects->where('student_reg_number', $student_reg_number);

        $projects = $projects->get(); // Execute query

        return view('project', compact('projects', 'campuses', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student_reg_number = $request->student_reg_number;
        $department_code = $request->department_code;
        $faculty_code = $request->faculty_code;
        return view('project_form', compact('student_reg_number','department_code','faculty_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_problem' => 'required|string',
            'project_solution' => 'required|string',
            'project_abstract' => 'required|string',
            'project_dissertation' => 'required|string',
            'project_source_code' => 'required|string',
            'student_reg_number' => 'required|string',
            'department_code' => 'required|string',
            'faculty_code' => 'required|string',
        ]);

        $studentRegNumber = $request->student_reg_number;
        $departmentCode = $request->department_code;
        $facultyCode = $request->faculty_code;
        $currentYear = Carbon::now()->year;

        // Ensure the student is not registered in multiple projects
        if (Project::where('student_reg_number', $studentRegNumber)->exists()) {
            return redirect()->back()->with('error', 'You are already assigned to a project.');
        }

        // Generate project code
        $lastProjectCode = Project::whereYear('created_at', $currentYear)
            ->where('department_code', $departmentCode)
            ->where('faculty_code', $facultyCode)
            ->max('project_code');

        $increment = $lastProjectCode ? (int)substr($lastProjectCode, -3) + 1 : 1;
        $projectCode = $currentYear . $departmentCode . $facultyCode . str_pad($increment, 3, '0', STR_PAD_LEFT);

        // Create project
        Project::create([
            'project_code' => $projectCode,
            'project_name' => $request->project_name,
            'project_problem' => $request->project_problem,
            'project_solution' => $request->project_solution,
            'project_abstract' => $request->project_abstract,
            'project_dissertation' => $request->project_dissertation,
            'project_source_code' => $request->project_source_code,
            'student_reg_number' => $studentRegNumber,
            'department_code' => $departmentCode,
            'faculty_code' => $facultyCode,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Project proposal submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_code)
    {
        $project = Project::findOrFail($project_code);
        return view('project_view', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('project_edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_code)
    {
        $project = Project::findOrFail($project_code);

        // Update project details
        $project->project_problem = $request->project_problem;
        $project->project_solution = $request->project_solution;
        $project->project_abstract = $request->project_abstract;
        $project->project_dissertation = $request->project_dissertation;
        $project->project_source_code = $request->project_source_code;

        $project->save();

        return redirect()->route('student.dashboard')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('student.dashboard')->with('success', 'Project deleted successfully.');
    }



    // Supervisor Assigning and Approval
    public function assignSupervisorForm($project_code)
    {
        $project = Project::findOrFail($project_code);
        $supervisors = Supervisor::all();
        return view('assign_supervisor', compact('project', 'supervisors'));
    }




    public function assignSupervisor(Request $request, $project_code)
    {
        $request->validate([
            'supervisor_email' => 'required|exists:supervisors,email',
        ]);
        $project_code = $request->project_code;
        $project = Project::findOrFail($project_code);
        $project->supervisor_email = $request->supervisor_email;
        $project->save();

        return redirect()->route('projects.assignSupervisorForm',$project->project_code)->with('success', 'Supervisor assigned successfully.');
    }





    public function supervisorApprove(Request $request, $project_code)
    {
        $request->validate([
            'supervisor_email' => 'required|exists:supervisors,email',
        ]);
        $project = Project::findOrFail($project_code);
        $project->supervisor_email = $request->supervisor_email;
        $project->save();

        return redirect()->route('projects.assignSupervisorForm', $project->project_code)->with('success', 'Supervisor approved successfully.');
    }





    public function supervisorApproval(Request $request, $supervisor_email)
    {
        $projects = Project::where('supervisor_email', $supervisor_email)->get();
        return view('project_approval', compact('projects'));
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



    public function approve(Request $request, $project_code)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $project = Project::where('project_code', $project_code)->firstOrFail();
        $project->status = 'Approved';
        $project->comment = $request->comment;
        $project->save();

        return redirect()->back()->with('success', 'Project approved successfully.');
    }


    public function reject(Request $request, $project_code)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $project = Project::where('project_code', $project_code)->firstOrFail();
        $project->status = 'Rejected';
        $project->comment = $request->comment;
        $project->save();

        return redirect()->back()->with('success', 'Project rejected successfully.');
    }


}
