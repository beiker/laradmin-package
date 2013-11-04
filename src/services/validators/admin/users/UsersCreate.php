<?php namespace Validators\Admin;

use Validators\Validator;

class UsersCreate extends Validator {

  public static $rules = array(

    'name'     => array('rules' => 'required'),
    'user'     => array('rules' => 'required|unique:users,user'),
    'password' => array('rules' => 'required|min:6'),
    'email'    => array('rules' => 'email|unique:users,email'),
    'type'     => array('rules' => 'required'),
    'avatar'   => array('rules' => 'image|max:2048'),

  );

}