<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::orderBy('id')->simplePaginate(10);
        return view('task_statuses.index', ['taskStatuses' => $taskStatuses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
            $taskStatus = new TaskStatus();
            return view('task_statuses.create', ['taskStatus' => $taskStatus]);
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:task_statuses|string|max:255',
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($validated)->save();
        session()->flash('message', 'Статус успешно создан');
        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        if (auth()->check()) {
            return view('task_statuses.edit', ['taskStatus' => $taskStatus]);
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        /* $validated = $request->validate([
            'name' => 'required|string|max:255|unique:task_statuses,name,' . $taskStatus->id,
        ]); */
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:task_statuses',
        ]);

        $taskStatus->fill($validated)->save();
        session()->flash('message', 'Статус успешно изменён');
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();
        session()->flash('message', 'Статус успешно удалён');
        // session()->flash('message', 'Не удалось удалить статус');
        return redirect()->route('task_statuses.index');
    }
}
