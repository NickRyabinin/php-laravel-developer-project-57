@extends('layouts.app')

@section('header', 'Привет от Хекслета!')

@section('content')
    <p class="my-4">Это простой менеджер задач на Laravel. Позволяет ставить задачи, менять их статусы, прикреплять метки, назначать исполнителей.
        Для работы с системой требуется регистрация и аутентификация.</p>
    <p class="my-4">Применяемый стек: PHP/Laravel/Blade/Eloquent. Регистрация и аутентификация сделаны с использованием Breeze (при сбросе пароля
        пользователя email на реальный адрес не отправляется, вместо этого используется сервис mailtrap.io). Стилизация - Tailwind CSS.
        Используемая БД - PostgreSQL.</p>
    <a href="https://github.com/NickRyabinin" target="__blank"
        class="align-middle bg-transparent hover:bg-blue-500 text-blue-700 text-base font-semibold py-1 px-2 hover:text-white border border-blue-500 hover:border-transparent rounded">
        Нажми меня
    </a>
@endsection
