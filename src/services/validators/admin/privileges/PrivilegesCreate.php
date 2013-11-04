<?php namespace Validators\Admin;

use Validators\Validator;

class PrivilegesCreate extends Validator {

  public static $rules = array(

    'name'       => array('rules' => 'required|max:100'),
    'url_action' => array('rules' => 'required|max:100'),
    'url_icon'   => array('rules' => 'max:100'),

  );

}