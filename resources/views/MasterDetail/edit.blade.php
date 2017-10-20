@extends('layouts.app')

@section('content')
<div class="container"><h1>Edit {{ $masters['name'] }}</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::model($masters, array('route' => array('master.update', $masters['utility_ID']), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('utility_ID', 'ID') }}
        {{ Form::text('utility_ID', Request::old('utility_ID'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('sub_name', 'Sub Name') }}
        {{ Form::textarea('sub_name', Request::old('utility_sub_name'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Details!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection