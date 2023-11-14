<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::orderBy('id')->simplePaginate(10);
        return view('labels.index', ['labels' => $labels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
            $label = new Label();
            return view('labels.create', ['label' => $label]);
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
                'name' => 'required|unique:labels|string|max:255',
                'description' => 'max:10000',
            ],
            [
                'unique' => __('validation.unique_entity', ['entity' => 'Метка']),
            ]
        );

        $label = new Label();
        $label->fill($validated)->save();
        session()->flash('message', 'Метка успешно создана');
        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        if (auth()->check()) {
            return view('labels.edit', ['label' => $label]);
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:labels',
            'description' => 'max:10000',
        ]);

        $label->fill($validated)->save();
        session()->flash('message', 'Метка успешно изменена');
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if ($label->tasks->isEmpty()) { // @phpstan-ignore-line
            $label->delete();
            session()->flash('message', 'Метка успешно удалена');
        } else {
            session()->flash('message', "Не удалось удалить метку");
        }
        return redirect()->route('labels.index');
    }
}
