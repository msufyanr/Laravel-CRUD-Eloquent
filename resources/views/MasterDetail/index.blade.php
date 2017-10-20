@extends('layouts.app')

@section('content')
<div class="container">

<h1><strong>Master Detail !</strong></h1>
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Sub Name</td>
            
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>

    @foreach($masterdetails as $key => $value)
        <tr>
            <td>{{ $value->utility_ID }}</td>
            <td>{{ $value->name }}</td>
            	<?php   $temp=$value->detailutilities;
                        $utilityID=$value->utility_ID ?>
            <td>
            		@foreach($temp as $key => $value)
            			{{ $value->utility_sub_name }} <br>
            		@endforeach

            </td>
            
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'masterdetail/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Key', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('master/' . $utilityID ) }}">Show this Key</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('master/' . $utilityID . '/edit') }}">Edit this Key</a>

            </td>
        </tr>
    @endforeach


    </tbody>
</table>
@endsection