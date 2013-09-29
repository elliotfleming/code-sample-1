@extends('layouts.master')

@section('title', 'Every Equity - Admin')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1><i class="icon-group"></i> Users</h1>
    </div>

    <p><a href="{{ URL::route('admin.users.create') }}" class="btn btn-success"><i class="icon-white icon-plus-sign"></i> Add User</a></p>

    @if ($users->count())
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><i class="icon-envelope"></i> Email</th>
                    <th><i class="icon-user"></i> First Name</th>
                    <th><i class="icon-user"></i> Last Name</th>
                    <th><i class="icon-globe"></i> Location</th>
                    <th class="text-center" colspan="2"><i class="icon-cogs"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{{ $user->email }}}</td>
                        <td>{{{ $user->profile->first_name }}}</td>
                        <td>{{{ $user->profile->last_name }}}</td>
                        <td>{{{ $user->profile->city.', '.$user->profile->state }}}</td>
                        <td class="text-center">
                            @if (Authority::can('update', 'Users', $user))
                                <a href="{{ URL::route('admin.users.edit', array($user->id)) }}" class="submit btn btn-xs btn-info"><i class="icon-edit"></i> Edit</a>
                            @else
                                --
                            @endif
                        </td>
                        <td class="text-center">
                            @if (Authority::can('delete', 'Users', $user))
                                @if ($user->trashed())
                                    <a href="{{ URL::route('admin.users.restore', array($user->id)) }}" class="submit btn btn-xs btn-success"><i class="icon-undo"></i> Restore</a>
                                @else
                                    {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.users.destroy', $user->id))) }}
                                        <button type="submit" class="submit btn btn-xs btn-danger"><i class="icon-trash"></i> Delete</button>
                                    {{ Form::close() }}
                                @endif
                            @else
                                --
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        There are no users
    @endif

</div> <!--End .container-->

@stop