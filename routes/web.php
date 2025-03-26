<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'homepage'])->name('task.homepage');
Route::post('/newTask', [TaskController::class, 'createTask'])->name('task.createTask');
Route::put('/editTask/{id}', [TaskController::class, 'editTask'])->name('task.editTask');
Route::delete('/deleteTask/{id}', [TaskController::class, 'deleteTask'])->name('task.deleteTask');
