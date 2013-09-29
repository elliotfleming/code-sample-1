@extends('layouts.master')

@section('title', 'Every Equity')

@section('content')

<div class="container">
    
    <div class="page-heading text-center">
        <h1><i class="icon-home"></i> Home</h1>
    </div>
    
    <!--
    <form name="login-form" id="login-form" class="login-ajax" action="{{ URL::route('auth.login.post') }}" method="get">
        <input type="email" name="email" id="email" placeholder="Email" value="{{ Input::old('email') }}">
        <input type="password" name="password" id="password">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <button type="submit" class="submit">Sign Up</button>
    </form>
    -->

</div> <!--End .container-->

@stop