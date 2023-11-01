<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('id')->simplePaginate(10);
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
            $task = new Task();
            return view('tasks.create', ['task' => $task]);
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (auth()->check()) {
            return view('tasks.edit', ['task' => $task]);
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $taskStatus->delete();
            session()->flash('message', 'Задача успешно удалена');
            // session()->flash('message', 'Не удалось удалить задачу');
            return redirect()->route('tasks.index');
    }
}
