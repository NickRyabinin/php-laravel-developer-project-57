@extends('layouts.app')

@section('header')
    Просмотр задачи: {{$task->name}}
    <div class="inline">
        <a href="{{ route('tasks.edit', $task) }}">&#9881;</a>
    </div>
@endsection

@section('content')
    <p class="mb-2">Имя: {{ $task->name }}</p>
    <p class="mb-2">Статус: {{ $task->id }}</p>
    <p class="mb-2">Описание: {{ $task->description }}</p>
    <p class="mb-2">Метки: {{ $task->id }}</p>
@endsection
