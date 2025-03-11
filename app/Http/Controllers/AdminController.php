<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class AdminController extends Controller
{
    public function index()
    {
        // Return the admin dashboard view
        return view('admin_dashboard'); // Replace 'admin_dashboard' with the name of your admin dashboard view
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function manageProjects()
    {
        $projects = Project::all();
        return view('admin.projects', compact('projects'));
    }

    public function manageSupervisors()
    {
        $supervisors = User::where('role', 'supervisor')->get();
        return view('admin.supervisors', compact('supervisors'));
    }
}
