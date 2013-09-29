<?php namespace App\Services\Validators;

/**
 * Add the following line to use this validator:
 * use App\Services\Validators\UserValidator;
 */
class UserValidator extends Validator {
 
    public static $rules = [
        'email'    				=> 'required|max:128|email|unique:users',
        'password' 				=> 'required|confirmed',
        'password_confirmation' => 'required',
    ];
}
