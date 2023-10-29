@extends('layouts.app')

@section('header', 'Статусы')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                @auth
                    <div>
                        <a href="https://php-task-manager-ru.hexlet.app/task_statuses/create"
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
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tr class="border-b border-dashed text-left">
                        <td>1</td>
                        <td>новая</td>
                        <td>29.10.2023</td>
                        <td>
                            @auth
                                <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/1">
                                    Удалить </a>
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/1/edit">
                                    Изменить </a>
                            @endauth
                        </td>
                    </tr>
                    <tr class="border-b border-dashed text-left">
                        <td>2</td>
                        <td>завершена</td>
                        <td>29.10.2023</td>
                        <td>
                            @auth
                                <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/2">
                                    Удалить </a>
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/2/edit">
                                    Изменить </a>
                            @endauth
                        </td>
                    </tr>
                    <tr class="border-b border-dashed text-left">
                        <td>3</td>
                        <td>выполняется</td>
                        <td>29.10.2023</td>
                        <td>
                            @auth
                                <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/3">
                                    Удалить </a>
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/3/edit">
                                    Изменить </a>
                            @endauth
                        </td>
                    </tr>
                    <tr class="border-b border-dashed text-left">
                        <td>4</td>
                        <td>в архиве</td>
                        <td>29.10.2023</td>
                        <td>
                            @auth
                                <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/4">
                                    Удалить </a>
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="https://php-task-manager-ru.hexlet.app/task_statuses/4/edit">
                                    Изменить </a>
                            @endauth
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </section>
@endsection
