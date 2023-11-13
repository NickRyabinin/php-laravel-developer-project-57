@extends('layouts.app')

@section('header')
    __('Просмотр задачи'): {{ $task->name }}
    <div class="inline">
        <a href="{{ route('tasks.edit', $task) }}">&#9881;</a>
    </div>
@endsection

@section('content')
    <p class="mb-2">{{ __('Имя') }}: {{ $task->name }}</p>
    <p class="mb-2">{{ __('Статус') }}: {{ $task->taskStatus->name }}</p>
    <p class="mb-2">{{ __('Описание') }}: {{ $task->description }}</p>
    <p class="mb-2">{{ __('Метки') }}:</p>
    <div>
        @foreach ($task->labels as $label)
            <p class="ml-4">&#127991;&nbsp;{{ $label->name }}</p>
        @endforeach
    </div>
@endsection
