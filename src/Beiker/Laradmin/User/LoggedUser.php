<?php namespace Beiker\Laradmin\User;

use Beiker\Laradmin\Storage\User\EloquentUserRepository;

class LoggedUser {

  /**
   * Constructor.
   *
   * @return void
   */
  function __construct(EloquentUserRepository $user)
  {
    $this->user = $user;
  }

  public function getId()
  {
    return Auth::user()->id;
  }

}
