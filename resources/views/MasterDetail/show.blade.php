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
<h1>Showing {{ $masters['name'] }}</h1>

    <div class="jumbotron ">
        <h2><strong>{{ $masters['name'] }}</strong></h2>
        <p>
        	@foreach($masters['sub_name'] as $key => $value)
            <strong>Detail Name:</strong> {{ $value }}<br>
            @endforeach
        </p>
    </div>

</div>
</body>
</html>