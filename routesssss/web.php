<?php

//use App\Http\Controllers\ProfileController;
//use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HeadOfDepartmentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;


// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    switch ($role) {
        case 'admin':
            return view('dashboard.admin');
        case 'hod':
            return view('dashboard.hod');
        case 'supervisor':
            return view('dashboard.supervisor');
        case 'student':
            return view('dashboard.student');
        default:
            abort(403, 'Unauthorized access.');
    }
})->middleware('auth')->name('dashboard');


// Authentication Routes
Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('campuses', CampusController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('faculties', FacultyController::class);
    });

    // Head of Department Routes
    Route::middleware(['role:hod'])->group(function () {
        Route::resource('hods', HeadOfDepartmentController::class);
    });

    // Supervisor Routes
    Route::middleware(['role:supervisor'])->group(function () {
        Route::resource('supervisors', SupervisorController::class);
    });

    // Student Routes
    Route::middleware(['role:student'])->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('projects', ProjectController::class);
    });
});




Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/projects', [AdminController::class, 'manageProjects'])->name('admin.projects');
    Route::get('/admin/supervisors', [AdminController::class, 'manageSupervisors'])->name('admin.supervisors');
});





Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

