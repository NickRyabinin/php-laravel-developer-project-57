@extends('layouts.app')

@section('header', 'Изменение метки')

@section('content')
    <section>
        <div class="grid max-w-screen-xl pt-10 pb-10 mx-auto lg:gap-8 xl:gap-0 lg:py-10 lg:grid-cols-12">
            <div class="grid col-span-full">
                {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'PATCH']) }}
                @include('labels.form')
                {{ Form::submit('Обновить', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection
