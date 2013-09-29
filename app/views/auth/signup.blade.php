@extends('layouts.master')

@section('title', 'Every Equity - Sign Up')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <div class="panel panel-default">
                
                <div class="panel-heading text-center">
                    <h3 class="panel-title"><i class="icon-check"></i> Sign Up</h3>
                </div>

                <div class="panel-body">
                    
                    @if ($errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error.'<br>' }}
                            @endforeach
                        </div>
                    @endif

                    <!--<pre><?php print_r($errors) ?></pre>-->

                    <form role="form" name="signup-form" id="signup-form" method="post">
                        <div class="form-group">
                            <label for="email" class="control-label"><i class="icon-user"></i> Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ Input::old('email') }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label"><i class="icon-lock"></i> Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="control-label"><i class="icon-lock"></i> Confirm Password</label>
                            <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="submit btn btn-info"><i class="icon-check"></i> Sign Up</button>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </form>

                </div>

            </div> <!--End .panel-->

        </div>
    </div> <!--End .row-->

</div> <!--End .container-->

@stop