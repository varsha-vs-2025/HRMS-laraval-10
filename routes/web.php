<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\EmployeeScoresController;
use App\Http\Controllers\EmployeeLeaveRequestsController;
use App\Http\Controllers\EmployeeLeavesController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\RecruitmentsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ScoreCategoriesController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ProfilesController;

// ✅ Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

// ✅ Auth routes (disable reset, verify, etc. as needed)
Auth::routes([
    'register' => true,
    'verify' => false,
    'reset' => false,
]);

// ✅ Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ✅ Protected Routes
Route::middleware('auth')->group(function () {

    // ─────── EMPLOYEE MANAGEMENT ───────
    Route::resource('employees-data', EmployeesController::class);

    // ─────── DEPARTMENTS & POSITIONS ───────
    Route::resource('departments-data', DepartmentsController::class);
    Route::resource('positions-data', PositionsController::class);

    // ─────── SCORES & LEAVES ───────
    Route::resource('employees-performance-score', EmployeeScoresController::class);
    Route::resource('employees-leave-request', EmployeeLeaveRequestsController::class);
    Route::resource('employee-leaves', EmployeeLeavesController::class);

    // ─────── LEAVE SHORTCUTS ───────
    Route::get('/leave-management', [EmployeeLeavesController::class, 'index'])->name('leave.index');
    Route::get('/leave-management/apply', [EmployeeLeavesController::class, 'create'])->name('leave.create');
    Route::post('/leave-management/apply', [EmployeeLeavesController::class, 'store'])->name('leave.store');
    Route::get('/my-leaves', [EmployeeLeavesController::class, 'myLeaves'])->name('my-leaves');
    Route::post('/employee-leaves/{id}/approve', [EmployeeLeavesController::class, 'approve'])->name('employee-leaves.approve');
    Route::post('/employee-leaves/{id}/reject', [EmployeeLeavesController::class, 'reject'])->name('employee-leaves.reject');

    // ─────── ANNOUNCEMENTS ───────
    Route::resource('announcements', AnnouncementsController::class);
    Route::get('/announcements/print', [AnnouncementsController::class, 'print'])->name('announcements.print');

    // ─────── RECRUITMENT ───────
    Route::resource('recruitments', RecruitmentsController::class);

    // ─────── ROLES ───────
    Route::resource('roles', RolesController::class);

    // ─────── SCORE CATEGORIES ───────
    Route::get('/score-categories', [ScoreCategoriesController::class, 'index'])->name('score-categories.index');
    Route::resource('score-categories', ScoreCategoriesController::class)->except(['index']);

    // ─────── ATTENDANCE ───────
    Route::get('/attendances', [AttendancesController::class, 'index'])->name('attendances.index');
    Route::post('/attendances', [AttendancesController::class, 'store'])->name('attendances.store');
    Route::get('/attendances/print', [AttendancesController::class, 'print'])->name('attendances.print');
    Route::put('/attendances/{attendance}', [AttendancesController::class, 'update'])->name('attendances.update');

    // (Optional) Admin filtered attendance view (can be removed if you filter from same index)
    Route::get('/admin/attendances', [AttendancesController::class, 'adminIndex'])->name('admin.attendances.index');

    // ─────── USERS, PROFILE, LOGS ───────
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/profile', [ProfilesController::class, 'index'])->name('profile');
    Route::put('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
    Route::get('/logs', [LogsController::class, 'index'])->name('logs');

    // ─────── LEAVE ACTIONS ───────
    Route::get('/employees-leave-request/{id}/print', [EmployeeLeaveRequestsController::class, 'print'])->name('employees-leave-request.print');
    Route::get('/employees-leave-request/{id}/approve', [EmployeeLeaveRequestsController::class, 'approve'])->name('employees-leave-request.approve');
    Route::get('/employees-leave-request/{id}/reject', [EmployeeLeaveRequestsController::class, 'reject'])->name('employees-leave-request.reject');
});

// ✅ Optional debug helper
Route::get('/check-columns', function () {
    return [
        'location' => Schema::hasColumn('recruitments', 'location'),
        'deadline' => Schema::hasColumn('recruitments', 'deadline'),
    ];
});
