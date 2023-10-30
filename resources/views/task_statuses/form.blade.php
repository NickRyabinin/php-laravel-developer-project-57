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
{{ Form::text('name', '', ['class' => 'rounded border-blue-300 w-1/3 mb-2']) }}<br>
