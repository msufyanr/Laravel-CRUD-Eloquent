@extends('layouts.app')

@section('content')
<div class="container">
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
@endsection