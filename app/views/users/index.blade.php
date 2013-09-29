@extends('layouts.master')

@section('title', 'Every Equity - Users')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1><i class="icon-group"></i> All Users</h1>
    </div>

    @if ($users->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><i class="icon-envelope"></i> Email</th>
                    <th><i class="icon-user"></i> First Name</th>
                    <th><i class="icon-user"></i> Last Name</th>
                    <th><i class="icon-globe"></i> Location</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{{ $user->email }}}</td>
                        <td>{{{ $user->profile->first_name }}}</td>
                        <td>{{{ $user->profile->last_name }}}</td>
                        <td>{{{ $user->profile->city.', '.$user->profile->state }}}</td>
                        <td>
                            <a href="{{ URL::route('users.show', array($user->id)) }}" class="btn btn-xs btn-info"><i class="icon-search"></i> View User</a>
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