<div class="w-full flex items-center">
    {{ Form::model($task, ['route' => ['tasks.index', $tasks], 'method' => 'GET']) }}
    {{ Form::select('filter[status_id]', $taskStatuses, $filter['status_id'] ?? '', ['placeholder' => 'Статус', 'class' => 'rounded border-blue-300 mb-1']) }}
    {{ Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? '', ['placeholder' => 'Автор', 'class' => 'rounded border-blue-300 mb-1']) }}
    {{ Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? '', ['placeholder' => 'Исполнитель', 'class' => 'rounded border-blue-300 mb-1']) }}
    {{ Form::submit('Применить', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
    {{ Form::close() }}
</div>
