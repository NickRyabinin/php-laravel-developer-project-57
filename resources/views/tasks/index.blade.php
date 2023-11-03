@extends('layouts.app')

@section('header', 'Задачи')

@section('content')
    <section>
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                @auth
                    <div>
                        <a href="{{ route('tasks.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Создать задачу </a>
                    </div>
                @endauth
                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>ID</th>
                            <th>Статус</th>
                            <th>Имя</th>
                            <th>Автор</th>
                            <th>Исполнитель</th>
                            <th>Дата создания</th>
                            <th>
                                @auth
                                    Действия
                                @endauth
                            </th>
                        </tr>
                    </thead>
                    @foreach ($tasks as $task)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->taskStatus->name }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}"
                                    class="align-middle text-green-500">{{ $task->name }}
                                </a>
                            </td>
                            <td>{{ $task->creator->name }}</td>
                            <td>{{ $task->executor->name ?? '' }}</td>
                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                            <td>
                                @auth
                                    @if (auth()->user()->id === $task->creator->id)
                                        @include('tasks.delete')
                                    @endif
                                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                        Изменить
                                    </a>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
