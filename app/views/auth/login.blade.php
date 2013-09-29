@extends('layouts.master')

@section('title', 'Every Equity - Login')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <!--<pre><?php print_r($errors) ?></pre>-->

            <div class="panel panel-default">
                
                <div class="panel-heading text-center">
                    <h3 class="panel-title"><i class="icon-signin"></i> Login</h3>
                </div>

                <div class="panel-body">
    
                    @if ($errors->has('login'))
                        <div class="alert alert-danger">
                            Your credentials are incorrect.
                        </div>
                    @endif
                    @if ($errors->has('email') || $errors->has('password'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('email', ':message<br>') as $error)
                                {{ $error }}
                            @endforeach
                            @foreach ($errors->get('password', ':message<br>') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <form role="form" name="login-form" id="login-form" method="post">
                        <div class="form-group">
                            <label for="email" class="control-label"><i class="icon-user"></i> Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ Input::old('email') }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label"><i class="icon-lock"></i> Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="submit btn btn-info"><i class="icon-signin"></i> Login</button>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </form>

                </div>

            </div> <!--End .panel-->

        </div>
    </div> <!--End .row-->

</div> <!--End .container-->

@stop