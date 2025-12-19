<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view("welcome");
});

Route::post("/login",[StudentController::class,"store"])->name("student.login");
Route::get('/list',[StudentController::class,"index"]);
Route::delete("delete/{id}",[StudentController::class,"delete"])->name("login.delete");
Route::get("/edit/{id}",[StudentController::class,"user"])->name("edit.login");
Route::put('/edit/{id}', [StudentController::class, 'update'])->name('student.update');