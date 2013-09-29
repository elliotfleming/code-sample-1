@extends('splash.master')

@section('title', 'Every Equity')

@section('content')

	<div class="welcome">

		<!--<h1>Every Equity</h1>-->
	    <!--<div class="slogan">Matching Start-Ups to Talent & Investors Online</div>-->
	    <!--<div class="slogan">Matching Entrepreneurs & Investors</div>-->
	    <!--<div class="slogan">Every Idea Begins with a Scribble</div>-->
	    <div class="slogan">
	    	<p>
		    	<span class="highlight">Every Equity</span> is a community where ideas are born.
		    	<br>
		    	All ideas, no matter how profoundly different, have the same beginning:
		    	<br>
		    	A <em class="highlight">scribble</em>.
	    	</p>
    	</div>

    	<div id="logo">
	    	<img src="/img/logo-large-splash.png" width="350">
    	</div>

	    <div class="signup">
	        @if ($signedup)
	            <p>Thanks <span class="highlight">{{ $email }}</span></p>
	            @if ($cofounder || $founder || $investor)
	            	@if (isset($updated) && $updated)
						<span class="underline">Your preferences have been updated:</span><br>
					@else
						<span class="underline">You're signed up as:</span><br>
					@endif
	                <ul>
	                @if ($cofounder)
	                    <li>a <span class="highlight">Co-Founder</span></li>
	                @endif
	                @if ($founder)
	                    <li>a <span class="highlight">Founder</span></li>
	                @endif
	                @if ($investor)
	                    <li>an <span class="highlight">Investor</span></li>
	                @endif
	                </ul>
	            @endif
	            <div class="margin-top">We'll keep you updated on our progress. Thanks!</div>
	        @else
	            <p>I'm interested in...</p>
	            <div class="errors">
	                {{ $errors->first('email') }}
	            </div>
	            <form name="signup-form" id="signup-form" method="post">
	                <div class="user-type">
	                    <input type="checkbox" name="co-founder" id="co-founder" value="true">
	                    <label for="co-founder">Joining</label>
	                    <input type="checkbox" name="founder" id="founder" value="true">
	                    <label for="founder">Creating</label>
	                    <input type="checkbox" name="investor" id="investor" value="true">
	                    <label for="investor">Funding</label>
	                </div>
	                <p>a project.</p>
	                <input type="email" name="email" id="email" class="input-text" placeholder="Email" value="{{ Input::old('email') }}">
	                {{ Form::token() }}
	                <!--<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">-->
	                <button type="submit" class="submit">Sign Up</button>
	            </form>
	        @endif
	    </div>

	    <div class="social-media">
	        <a href="https://www.facebook.com/EveryEquity" target="_blank">
	            <i class="icon-facebook-sign facebook"></i>
	        </a>
	        <a href="https://twitter.com/EveryEquity" target="_blank">
	            <i class="icon-twitter-sign twitter"></i>
	        </a>
	        <br>
	        <a href="https://angel.co/every-equity" target="_blank" class="angellist">
	            <img src="/img/angellist_logo.png">
	        </a>
	    </div>

	</div>

@stop