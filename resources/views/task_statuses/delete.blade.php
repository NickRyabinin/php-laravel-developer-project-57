{{ Form::open(['route' => ['task_statuses.destroy', $taskStatus], 'method' => 'delete', 'class' => 'inline']) }}
{{ Form::button('Удалить', [
    'type' => 'submit',
    'class' =>
        'text-red-600 hover:text-red-900',
    'onclick' => "return confirm('Вы уверены?')",
]) }}
{{ Form::close() }}
