@extends('layouts.master')

@section('title', 'Every Equity - Admin - View User')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1>View User</h1>
    </div>

    <p><a href="{{ URL::route('admin.users.index') }}" class="btn btn-default"><i class="icon-white icon-plus-sign"></i> Return to all users</a></p>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Email</th>
                <th>Password</th>
                <th class="text-center" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{{ $user->email }}}</td>
                <td>{{{ $user->password }}}</td>
                <td class="text-center">{{ link_to_route('admin.users.edit', 'Edit', array($user->id), array('class' => 'btn btn-sm btn-info')) }}</td>
                <td class="text-center">
                    {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.users.destroy', $user->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
                    {{ Form::close() }}
                </td>
            </tr>
        </tbody>
    </table>

</div> <!--End .container-->

@stop