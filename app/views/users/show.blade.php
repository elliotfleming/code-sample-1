@extends('layouts.master')

@section('title', 'Every Equity - View User')

@section('content')

<div class="container">

    <div class="page-heading text-center">
        <h1><i class="icon-user"></i> {{{ $user->profile->first_name . ' ' . $user->profile->last_name }}}</h1>
        <h2>{{{ $user->profile->city . ', ' . $user->profile->state }}}</h2>
    </div>

</div> <!--End .container-->

@stop