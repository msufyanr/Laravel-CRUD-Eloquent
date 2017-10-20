<!doctype html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('master') }}">Master</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('master') }}">View All Master Keys</a></li>
        <li><a href="{{ URL::to('master/create') }}">Create a Master Key</a>
    </ul>
</nav>
<h1>Edit {{ $masters['name'] }}</h1>

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
</body>
</html>
