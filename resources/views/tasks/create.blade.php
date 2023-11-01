@extends('layouts.app')

@section('header', 'Создать задачу')

@section('content')
    <section>
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                {{ Form::model($task, ['route' => ['tasks.store', $task]]) }}
                @include('tasks.form')
                {{ Form::submit('Создать', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection
