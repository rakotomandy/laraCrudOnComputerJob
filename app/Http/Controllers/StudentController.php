<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentController extends Controller
{
    //
    public function store(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        Student::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return redirect('/list');
    }

    public function index(){
        $students=Student::all();
        return view("list", compact("students"));
    }

    public function delete($id){
        Student::find($id)->delete();
        return redirect('/list');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        $student = Student::findOrFail($id);
        $student->email = $validated['email'];
        $student->password =$validated['password'];
        $student->save();

        return redirect('/list');
    }

    public function user($id){
        $student=Student::find($id);
        return view("edit", compact("student"));
    }
}
