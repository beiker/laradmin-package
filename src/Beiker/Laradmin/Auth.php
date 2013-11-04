<?php namespace Beiker\Laradmin\Auth;

class Auth {

  public function authenticate($user)
  {
    // Add extra conditions to query.
    $user['type'] = 'admin';

    $user['deleted_at'] = null;

    unset($user['_token']);

    $remember = false;
    if (\Input::has('remember'))
    {
      $remember = true;
      unset($user['remember']);
    }

    // Attempt to log the user.
    if (\Auth::attempt($user, $remember))
    {
      // Crea la Session y guarda datos del usuario
      \Session::put('id',    \Auth::user()->id);
      \Session::put('name',  \Auth::user()->name);
      \Session::put('user',  \Auth::user()->user);
      \Session::put('email', \Auth::user()->email);
      \Session::put('tipo',  \Auth::user()->type);

      return array('passes' => true);
    }

    // Get message.
    $messages = trans(\Conf::langPath().'messages.admin-auth-fails');

    return array('passes' => false,
      'message' => \Util::liAlert($messages));
  }

}
