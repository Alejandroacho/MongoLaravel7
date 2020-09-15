<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        $tasks = $user->tasks();
        return view('task.index', ['tasks'=>$tasks]);
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $task = Task::create($request->all());
        $task->user_id = $user->_id;
        $task->save();
        return redirect(route('task.index'));
    }

    public function show(Task $task)
    {
        return view('task.show', ['task'=>$task]);
    }

    public function edit($task)
    {
        $task = Task::find($task);
        return view('task.edit', ['task'=>$task]);
    }

    public function update(Request $request,Task $task)
    {
        $task->update($request->all());
        return redirect(route('task.index'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('task.index'));
    }
}
