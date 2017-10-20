@extends('layouts.app')

@section('content')
<div class="container">
<h1>Showing {{ $nerds->name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $nerds->name }}</h2>
        <p>
            <strong>Email:</strong> {{ $nerds->email_address }}<br>
            <strong>Level:</strong> {{ $nerds->nerd_level }}
        </p>
    </div>

</div>
@endsection