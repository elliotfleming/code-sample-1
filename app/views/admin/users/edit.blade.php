@extends('layouts.master')

@section('title', 'Every Equity - Admin - Edit User')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1>Edit User</h1>
    </div>

    {{ Form::model($user, array('method' => 'PATCH', 'route' => array('admin.users.update', $user->id))) }}

        {{ Form::label('email', 'Email:') }}
        {{ Form::text('email') }}

        {{ Form::label('password', 'Password:') }}
        {{ Form::text('password') }}

        {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
        {{ link_to_route('admin.users.show', 'Cancel', $user->id, array('class' => 'btn btn-danger')) }}

    {{ Form::close() }}

    @if ($errors->any())
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    @endif

</div> <!--End .container-->

@stop