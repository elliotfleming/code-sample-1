@extends('layouts.master')

@section('title', 'Every Equity - Admin - Create User')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1>Create User</h1>
    </div>

    {{ Form::open(array('route' => 'admin.users.store')) }}
        
        {{ Form::label('email', 'Email:') }}
        {{ Form::text('email') }}

        {{ Form::label('password', 'Password:') }}
        {{ Form::text('password') }}

        {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

    {{ Form::close() }}

    @if ($errors->any())
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    @endif

</div> <!--End .container-->

@stop


