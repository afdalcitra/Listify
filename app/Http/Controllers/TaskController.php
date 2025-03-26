<?php

namespace App\Http\Controllers;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function homepage()
    {
        $tasks = Tasks::all();
        return view('welcome', compact('tasks'));
    }

    public function createTask(Request $request)
    {
        $task = new Tasks();
        $task->task_name = $request->newTask;
        $task->status = "pending";
        $task->save();
        return redirect()->route('task.homepage')->with('success', 'Task created successfully!');
    }

    public function editTask(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);
        $task->task_name = $request->editTask;
        $task->status = $request->editStatus;
        $task->save();
        return redirect()->route('task.homepage')->with('success', 'Task updated successfully!');
    }

    public function deleteTask($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();
        return redirect()->route('task.homepage')->with('success', 'Task deleted successfully!');
    }
}
