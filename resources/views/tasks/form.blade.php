@if ($errors->any())
    <div class="w-fit mx-auto mt-2 bg-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ Form::label('name', 'Имя', ['class' => 'block mb-2']) }}
{{ Form::text('name', (isset($task)) ? $task->name : '', ['class' => 'rounded border-blue-300 w-1/3 mb-2']) }}<br>
{{ Form::label('description', 'Описание', ['class' => 'block mb-2']) }}
{{ Form::textarea('description', (isset($task)) ? $task->description : '', ['class' => 'rounded border-blue-300 w-1/3 mb-2']) }}<br>
{{ Form::label('status_id', 'Статус', ['class' => 'block mb-2']) }}
{{ Form::select('status_id', $taskStatuses, null, ['placeholder' => '----------', 'class' => 'rounded border-blue-300 w-1/3 mb-2']) }}<br>
{{ Form::label('assigned_to_id', 'Исполнитель', ['class' => 'block mb-2']) }}
{{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------', 'class' => 'rounded border-blue-300 w-1/3 mb-2']) }}<br>
{{ Form::label('labels', 'Метки', ['class' => 'block mb-2']) }}
{{ Form::select('labels[]', $labels, null, ['multiple' => true, 'placeholder' => '', 'class' => 'rounded border-blue-300 w-1/3 mb-2']) }}<br>
