<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $task = new Task();
        $taskStatuses = TaskStatus::select('id', 'name')->pluck('name', 'id');
        $users = User::select('id', 'name')->pluck('name', 'id');
        $filter = $request->filter ?? null;
        $query = Task::query();
        if (is_array($filter)) {
            if ($filter['status_id']) {
                $query->where('status_id', $filter['status_id']);
            }
            if ($filter['created_by_id']) {
                $query->where('created_by_id', $filter['created_by_id']);
            }
            if ($filter['assigned_to_id']) {
                $query->where('assigned_to_id', $filter['assigned_to_id']);
            }
        }
        $tasks = $query->orderBy('id')->simplePaginate(10);
        return view(
            'tasks.index',
            [
                'task' => $task, 'tasks' => $tasks,
                'taskStatuses' => $taskStatuses,
                'users' => $users, 'filter' => $filter,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
            $task = new Task();
            $taskStatuses = TaskStatus::select('id', 'name')->pluck('name', 'id');
            $users = User::select('id', 'name')->pluck('name', 'id');
            $labels = Label::select('id', 'name')->pluck('name', 'id');
            return view(
                'tasks.create',
                [
                    'task' => $task,
                    'taskStatuses' => $taskStatuses,
                    'users' => $users,
                    'labels' => $labels,
                ]
            );
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:tasks|string|max:255',
                'description' => 'max:10000',
                'status_id' => 'required',
                'assigned_to_id' => '',
            ],
            [
                'unique' => __('validation.unique_entity', ['entity' => 'Задача']),
            ]
        );
        $labels = $request->input('labels', []);

        $task = new Task();
        $task->fill($validated)->fill(['created_by_id' => auth()->user()->id])->save(); // @phpstan-ignore-line
        $task->labels()->attach($labels);
        session()->flash('message', 'Задача успешно создана');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (auth()->check()) {
            $taskStatuses = TaskStatus::select('id', 'name')->pluck('name', 'id');
            $users = User::select('id', 'name')->pluck('name', 'id');
            $labels = Label::select('id', 'name')->pluck('name', 'id');
            return view(
                'tasks.edit',
                [
                    'task' => $task,
                    'taskStatuses' => $taskStatuses,
                    'users' => $users,
                    'labels' => $labels
                ]
            );
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tasks,name,' . $task->id,
            'description' => 'max:10000',
            'status_id' => 'required',
            'assigned_to_id' => '',
        ]);
        $labels = $request->input('labels', []);

        $task->fill($validated)->save();
        $task->labels()->detach();
        $task->labels()->attach($labels);
        session()->flash('message', 'Задача успешно изменена');
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        session()->flash('message', 'Задача успешно удалена');
        return redirect()->route('tasks.index');
    }
}
