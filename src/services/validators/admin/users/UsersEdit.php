<?php namespace Validators\Admin;

use Validators\Validator;

class UsersEdit extends Validator {

  public static $rules = array(

    'name'   => array('rules' => 'required', 'friendly' => 'Nombre'),
    'password' => array('rules' => 'min:6', 'friendly' => 'Password'),
    'type'     => array('rules' => 'required', 'friendly' => 'Tipo')

  );

  /**
   * ID del usuario a editar.
   *
   * @var int
   */
  private $user_id;

  public function __construct($user_id)
  {
    parent::__construct();

    $this->user_id = intval($user_id);

    $this->_checkUsuario();
    $this->_checkEmail();
  }

  /**
   * Validador de usuario.
   *
   * @return void
   */
  private function _checkUsuario()
  {
    $user = \User::where('user', \Input::get('user'))->first();

    static::$rules['user'] = array(
      'rules'    => 'required|unique:users,user'
    );

    if ( ! is_null($user))
    {
      if ($user->id == $this->user_id)
      {
        static::$rules['user'] = array(
          'rules'    => 'required'
        );
      }
    }
  }

  /**
   * Validador del email.
   *
   * @return void
   */
  private function _checkEmail()
  {
    if (empty($email)) return;

    $user = \User::where('email', \Input::get('email'))->first();

    static::$rules['email'] = array(
      'rules'    => 'email|unique:users,email'
    );

    if ( ! is_null($user))
    {
      if ($user->id == $this->user_id)
      {
        static::$rules['email'] = array(
          'rules'    => 'required'
        );
      }
    }
  }

}