<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampusController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. Now create something great!
|
*/

Route::get('/campus/create', [CampusController::class, 'create'])->name('campus.create');
Route::post('/campus/store', [CampusController::class, 'store'])->name('campus.store');

Route::get('/campuses', [CampusController::class, 'index'])->name('campus.index');
Route::get('/campus/{campus}/edit', [CampusController::class, 'edit'])->name('campus.edit');
Route::put('/campus/{campus}', [CampusController::class, 'update'])->name('campus.update');
Route::delete('/campus/{campus}', [CampusController::class, 'destroy'])->name('campus.destroy');



use App\Http\Controllers\DepartmentController;

// Department Routes
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/departments/store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');   
Route::get('/departments/{campus_id}', [DepartmentController::class, 'getDepartments'])->name('departments.get');
Route::get('/departments/edit/{department_code}', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::post('/departments/update/{department_code}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/departments/delete/{department_code}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
Route::get('/departments/search/{campus_id}', [DepartmentController::class, 'searchByCampus'])->name('departments.searchByCampus');



use App\Http\Controllers\FacultyController;

Route::get('/faculties/create', [FacultyController::class, 'create'])->name('faculties.create');
Route::get('/departments/by-campus/{campus_id}', [FacultyController::class, 'getDepartments']);
Route::get('/faculties', [FacultyController::class, 'index'])->name('faculties.index');
Route::post('/faculties', [FacultyController::class, 'store'])->name('faculties.store');
Route::get('/faculties/{faculty}/edit', [FacultyController::class, 'edit'])->name('faculties.edit');
Route::post('/faculties/{faculty}', [FacultyController::class, 'update'])->name('faculties.update');
Route::delete('/faculties/{faculty_code}', [FacultyController::class, 'destroy'])->name('faculties.destroy');






use App\Http\Controllers\HodAuthController;

Route::get('/hod/login', [HodAuthController::class, 'showLoginForm'])->name('hod.login');
Route::post('/hod/login', [HodAuthController::class, 'login'])->name('hod.login.submit');
Route::get('/hod/dashboard', function () {
    if (!session()->has('hod_email')) {
        return redirect()->route('hod.login')->with('error', 'Please log in first.');
    }
    return view('department_dashboard');
})->name('hod.dashboard');
Route::post('/hod/logout', [HodAuthController::class, 'logout'])->name('hod.logout');




use App\Http\Controllers\HeadOfDepartmentController;


Route::get('/hods', [HeadOfDepartmentController::class, 'index'])->name('hods.index');
Route::get('/hods/create', [HeadOfDepartmentController::class, 'create'])->name('hods.create'); // Show registration form
Route::post('/hods', [HeadOfDepartmentController::class, 'store'])->name('hods.store'); // Handle registration


use App\Http\Controllers\SupervisorController;

Route::get('/supervisor/dashboard', [SupervisorController::class, 'index'])->name('supervisor.dashboard');

Route::get('/supervisors/create', [SupervisorController::class, 'create']);
Route::get('/departments/by-campus/{campus_id}', [SupervisorController::class, 'getDepartments']);
Route::get('/supervisors/{department_code}/list', [SupervisorController::class, 'index'])->name('supervisors.index');
Route::post('/supervisors', [SupervisorController::class, 'store'])->name('supervisors.store');
Route::get('/supervisors/{supervisor}/edit', [SupervisorController::class, 'edit'])->name('supervisors.edit');
Route::post('/supervisors/{supervisor}', [SupervisorController::class, 'update'])->name('supervisors.update');
Route::delete('/supervisors/{email}', [SupervisorController::class, 'destroy'])->name('supervisors.destroy');



use App\Http\Controllers\SupervisorAuthController;

Route::get('/supervisor/login', [SupervisorAuthController::class, 'showLoginForm'])->name('supervisor.login');
Route::post('/supervisor/login', [SupervisorAuthController::class, 'login'])->name('supervisor.login.submit');
Route::get('/supervisor/dashboard', function () {
    if (!session()->has('supervisor_email')) {
        return redirect()->route('supervisor.login')->with('error', 'Please log in first.');
    }
    return view('supervisor_dashboard');
})->name('supervisor.dashboard');
Route::post('/supervisor/logout', [SupervisorAuthController::class, 'logout'])->name('supervisor.logout');


Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');

Route::get('/students/create', [StudentController::class, 'create']);
Route::get('/departments/by-campus/{campus_id}', [StudentController::class, 'getDepartments']);
Route::get('/faculties/by-department/{departmentCode}', [StudentController::class, 'getFaculties']);
Route::get('/students/{department_code}/list', [StudentController::class, 'index'])->name('students.index');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::post('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student_reg_number}', [StudentController::class, 'destroy'])->name('students.destroy');



use App\Http\Controllers\StudentAuthController;

Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.submit');
Route::get('/student/dashboard', function () {
    if (!session()->has('student_reg_number')) {
        return redirect()->route('student.login')->with('error', 'Please log in first.');
    }
    return view('student_dashboard');
})->name('student.dashboard');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');



use App\Http\Controllers\ProjectController;

Route::get('/projects/create/{student_reg_number}/{department_code}/{faculty_code}', [ProjectController::class, 'create']);
Route::get('/departments/by-campus/{campus_id}', [ProjectController::class, 'getDepartments']);
Route::get('/projects/by-department/{departmentCode}', [ProjectController::class, 'getFaculties']);
Route::get('/projects/{department_code}/list', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{department_code}/assign', [ProjectController::class, 'assign'])->name('projects.assign');
Route::get('/projects/{student_reg_number}/proposal', [ProjectController::class, 'proposal'])->name('projects.proposal');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project_code}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project_code}/update', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project_code}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/projects/{project_code}/assign-supervisor', [ProjectController::class, 'assignSupervisorForm'])->name('projects.assignSupervisorForm');
Route::put('/projects/{project_code}/assign-supervisor', [ProjectController::class, 'assignSupervisor'])->name('projects.assignSupervisor');

Route::get('/projects/{supervisor_email}/approval', [ProjectController::class, 'supervisorApproval'])->name('projects.supervisorApproval');
Route::put('/projects/{project}/approved', [ProjectController::class, 'approve'])->name('projects.approve');
Route::put('/projects/{project}/rejected', [ProjectController::class, 'reject'])->name('projects.reject');


use App\Http\Controllers\HomePageController;
Route::get('/', [HomePageController::class, 'index'])->name('homepage');


use App\Http\Controllers\AdminController;

// Admin Route
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');





use App\Http\Controllers\HodController;
Route::get('/hod/dashboard', [HeadOfDepartmentController::class, 'index'])->name('hod.dashboard');


// // use App\Http\Controllers\HomePageController;

// // Route::get('/', [HomePageController::class, 'index'])->name('homepage');





