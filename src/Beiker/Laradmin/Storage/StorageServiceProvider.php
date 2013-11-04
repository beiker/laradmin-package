<?php namespace Beiker\Laradmin\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

  public function register()
  {

    $this->app->bind(
      'Beiker\Laradmin\Storage\Privilege\PrivilegeRepositoryInterface',
      'Beiker\Laradmin\Storage\Privilege\EloquentPrivilegeRepository'
    );

    $this->app->bind(
      'Beiker\Laradmin\Storage\User\UserRepositoryInterface',
      'Beiker\Laradmin\Storage\User\EloquentUserRepository'
    );
  }

  public function boot()
  {
  }

}