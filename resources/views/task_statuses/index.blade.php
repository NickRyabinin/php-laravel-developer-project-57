@extends('layouts.app')

@section('header', __('Статусы'))

@section('content')
    <section>
        <div class="grid max-w-screen-xl pt-10 pb-10 mx-auto lg:gap-8 xl:gap-0 lg:py-10 lg:grid-cols-12">
            <div class="grid col-span-full">
                @auth
                    <div>
                        <a href="{{ route('task_statuses.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Создать статус') }} </a>
                    </div>
                @endauth
                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Имя') }}</th>
                            <th>{{ __('Дата создания') }}</th>
                            <th>
                                @auth
                                    {{ __('Действия') }}
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
                                <a data-method="delete" data-confirm="{{ __('Вы уверены?') }}" href="{{ route('task_statuses.destroy', $taskStatus) }}" class="text-red-600 hover:text-red-900">
                                    {{ __('Удалить') }}
                                </a>
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="{{ route('task_statuses.edit', $taskStatus) }}">
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
