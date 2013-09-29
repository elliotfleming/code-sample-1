@extends('layouts.master')

@section('title', 'Every Equity - Account')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1><i class="icon-user"></i> Account</h1>
    </div>
    
    <div class="row">

        <div class="col-md-2">
            
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon-key"></i> Permissions</h3>
                </div>

                <ul class="list-group">
                    <li class="list-group-item"><?php if (Authority::can('create', 'Account')) echo 'Create' ?></li>
                    <li class="list-group-item"><?php if (Authority::can('read', 'Account')) echo 'Read' ?></li>
                    <li class="list-group-item"><?php if (Authority::can('update', 'Account')) echo 'Update' ?></li>
                    <li class="list-group-item"><?php if (Authority::can('delete', 'Account')) echo 'Delete' ?></li>
                </ul>

            </div> <!--End .panel-->

        </div>

        <div class="col-md-3">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon-cogs"></i> Settings</h3>
                </div>
    
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ URL::to('account/privacy') }}"><i class="icon-edit"></i> Edit Your Privacy Settings</a></li>
                    <li class="list-group-item"><a href="{{ URL::to('account/profile') }}"><i class="icon-edit"></i> Edit Your Profile</a></li>
                    <li class="list-group-item"><a href="{{ URL::to('account/settings') }}"><i class="icon-edit"></i> Edit Your Account Settings</a></li>
                </ul>

            </div> <!--End .panel-->

        </div>

    </div> <!--End .row-->

</div> <!--End .container-->

@stop