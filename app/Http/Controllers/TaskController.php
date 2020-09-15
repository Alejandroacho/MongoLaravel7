<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', ['tasks'=>$tasks]);
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        Task::create($request->all());
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
