@extends('layouts.app')

@section('header', 'Статусы')

@section('content')
    <section>
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                @auth
                    <div>
                        <a href="{{ route('task_statuses.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Создать статус </a>
                    </div>
                @endauth
                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Дата создания</th>
                            <th>
                                @auth
                                    Действия
                                @endauth
                            </th>
                        </tr>
                    </thead>
                    @foreach ($taskStatuses as $taskStatus)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at->format('d.m.Y')}}</td>
                        <td>
                            @auth
                                @include('task_statuses.delete')
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="{{ route('task_statuses.edit', $taskStatus) }}">
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
