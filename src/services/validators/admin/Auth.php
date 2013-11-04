<?php namespace Validators\Admin;

use Validators\Validator;

class Auth extends Validator {

  public static $rules = array(

    'user'     => array('rules' => 'required', 'friendly' => 'Usuario'),
    'password' => array('rules' => 'required', 'friendly' => 'Password'),

  );

}