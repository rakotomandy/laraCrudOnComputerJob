<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * StudentController - Handle student CRUD and authentication
 *
 * LOGIN FLOW:
 * 1. GET /login (AdminRight middleware blocks if user authenticated)
 * 2. POST /login → store() method
 *    - Validates email and password
 *    - Calls Auth::guard('student')->attempt() to authenticate
 *    - On success: Creates session, redirects to /list
 *    - On failure: Redirects to /login with error message
 * 3. GET /list (CheckLogin middleware requires authentication)
 */
class StudentController extends Controller
{
    /**
     * store() - Handle login form submission
     *
     * Validates input, attempts authentication with student guard.
     * If successful, creates session with student_id.
     * If unsuccessful, returns to login with error message.
     */
    public function store(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        // Attempt authentication: Query students table and verify password hash
        // Auth::guard('student')->attempt() does:
        // - Finds student by email
        // - Uses Hash::check() to verify password against database hash
        // - Creates session with student_id if credentials match
        // - Returns true/false based on result
        if (Auth::guard('students')->attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('list');
        }

        // Authentication failed - return to login with error
        return view("welcome");
    }

    /**
     * index() - Display all students
     * Protected by CheckLogin middleware - requires authentication
     */
    public function index()
    {
        return view("list");
    }

    /**
     * delete() - Remove a student record
     * Protected by CheckLogin middleware - requires authentication
     */
    public function delete($id)
    {
        Student::find($id)->delete();
        return redirect()->route("list");
    }

    /**
     * update() - Save student changes
     * Protected by CheckLogin middleware - requires authentication
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        $student = Student::findOrFail($id);
        $student->email = $validated['email'];
        $student->password = $validated['password'];
        $student->save();

        return redirect()->route("list");
    }

    public function logout(Request $request)
    {
        Auth::guard('students')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }
    /**
     * user() - Show student edit form
     * Protected by CheckLogin middleware - requires authentication
     */
    public function user($id)
    {
        $student = Student::find($id);
        return view("edit", compact("student"));
    }
}
