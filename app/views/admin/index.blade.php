@extends('layouts.master')

@section('title', 'Every Equity - Admin')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1><i class="icon-cogs"></i> Admin</h1>
    </div>

    <div class="row">

        <div class="col-md-2">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon-key"></i> Permissions</h3>
                </div>

                <ul class="list-group">
                    <li class="list-group-item"><?php if (Authority::can('create', 'Admin')) echo 'Create' ?></li>
                    <li class="list-group-item"><?php if (Authority::can('read', 'Admin')) echo 'Read' ?></li>
                    <li class="list-group-item"><?php if (Authority::can('update', 'Admin')) echo 'Update' ?></li>
                    <li class="list-group-item"><?php if (Authority::can('delete', 'Admin')) echo 'Delete' ?></li>
                </ul>

            </div> <!--End .panel-->

        </div>

        <div class="col-md-5">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <a href="{{ URL::to('admin/users') }}" class="pull-right"><i class="icon-wrench"></i> Manage Users</a>
                    <h3 class="panel-title"><i class="icon-group"></i> Users</h3>
                </div>

                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item">
                            {{ $user->email }}
                            @foreach ($user->roles as $role)
                                - {{ $role->name }}
                            @endforeach
                            @foreach ($user->permissions as $permission)
                                - {{ $permission->action.': '.$permission->type.' '.$permission->resource }}
                            @endforeach
                        </li>
                    @endforeach
                </ul>

            </div> <!--End .panel-->

        </div>

    </div> <!--End .row-->

</div> <!--End .container-->

@stop