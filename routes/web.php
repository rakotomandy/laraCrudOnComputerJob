<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/**
 * ROUTING STRUCTURE WITH AUTHENTICATION
 *
 * Three route categories:
 *
 * 1. PUBLIC ROUTES (No middleware)
 *    - GET / → Home page, accessible to everyone
 *
 * 2. LOGIN ROUTES (Protected by AdminRight middleware)
 *    - GET /login → Shows login form (only if NOT logged in)
 *    - POST /login → Processes form submission (public, needed for submission)
 *
 * 3. PROTECTED ROUTES (Protected by CheckLogin middleware)
 *    - GET /list → Display all students
 *    - GET /edit/{id} → Show edit form
 *    - PUT /edit/{id} → Save changes
 *    - DELETE /delete/{id} → Delete student
 *
 * MIDDLEWARE FLOW:
 * AdminRight: Checks Auth::guard('student')->check()
 *   - If TRUE (logged in): Redirect to /list
 *   - If FALSE (not logged in): Show login form
 *
 * CheckLogin: Checks Auth::guard('student')->check()
 *   - If TRUE (logged in): Allow access to route
 *   - If FALSE (not logged in): Redirect to /login
 */

// PUBLIC ROUTE
Route::get('/', function () {
    return view("welcome");
});

// LOGIN ROUTES
// GET /login - Show form (guest:student prevents access if already logged in)
Route::middleware("guest:students")->group(function () {
    Route::get('/login', function () {
        return view('welcome');
    })->name('login');

    // POST /login - Process form (no middleware, public endpoint for form submission)
    Route::post("/login", [StudentController::class, "store"])->name("student.login");
});


// PROTECTED ROUTES - auth:student requires authentication for all routes in this group
Route::middleware("auth:students")->group(function () {
    // Display all students
    Route::get('/list', [StudentController::class, "index"])->name('list');

    // Show edit form for a student
    Route::get("/edit/{id}", [StudentController::class, "user"])->name("edit.login");

    Route::post("logout", [StudentController::class, "logout"])->name("logout");

    // Save student changes
    Route::put('/edit/{id}', [StudentController::class, 'update'])->name('student.update');

    // Delete a student
    Route::delete("delete/{id}", [StudentController::class, "delete"])->name("login.delete");
});
