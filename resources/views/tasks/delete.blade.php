{{ Form::open(['route' => ['tasks.destroy', $task], 'method' => 'delete', 'class' => 'inline']) }}
{{ Form::button('Удалить', [
    'type' => 'submit',
    'class' =>
        'text-red-600 hover:text-red-900',
    'onclick' => "return confirm('Вы уверены?')",
]) }}
{{ Form::close() }}
