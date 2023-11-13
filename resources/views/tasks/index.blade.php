@extends('layouts.app')

@section('header', __('Задачи'))

@section('content')
    @include('tasks.filter')
    <section>
        <div class="grid max-w-screen-xl pt-10 pb-10 mx-auto lg:gap-8 xl:gap-0 lg:py-10 lg:grid-cols-12">
            <div class="grid col-span-full">
                @auth
                    <div>
                        <a href="{{ route('tasks.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Создать задачу') }}
                        </a>
                    </div>
                @endauth
                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Статус') }}</th>
                            <th>{{ __('Имя') }}</th>
                            <th>{{ __('Автор') }}</th>
                            <th>{{ __('Исполнитель') }}</th>
                            <th>{{ __('Дата создания') }}</th>
                            <th>
                                @auth
                                {{ __('Действия') }}
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
                                        <a data-method="delete" data-confirm="{{ __('Вы уверены?') }}" href="{{ route('tasks.destroy', $task) }}" class="text-red-600 hover:text-red-900">
                                            {{ __('Удалить') }}
                                        </a>
                                    @endif
                                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                        {{ __('Изменить') }}
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
