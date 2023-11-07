<div class="w-full flex items-center">
    {{ Form::model($tasks, ['route' => ['tasks.index', $tasks]]) }}
    {{ Form::select('status_id', $taskStatuses, null, ['placeholder' => 'Статус', 'class' => 'rounded border-blue-300 mb-1']) }}
    {{ Form::select('created_by_id', $users, null, ['placeholder' => 'Автор', 'class' => 'rounded border-blue-300 mb-1']) }}
    {{ Form::select('assigned_to_id', $users, null, ['placeholder' => 'Исполнитель', 'class' => 'rounded border-blue-300 mb-1']) }}
    {{ Form::submit('Применить', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
    {{ Form::close() }}
</div>
