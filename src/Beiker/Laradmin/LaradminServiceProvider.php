<?php namespace Beiker\Laradmin;

use Illuminate\Support\ServiceProvider;
use Beiker\Laradmin\View\ViewServiceProvider;
use Beiker\Laradmin\Console\LaradminInstallCommand;

class LaradminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('beiker/laradmin');

    include __DIR__.'/../../filters.php';
    include __DIR__.'/../../services/helpers/Macros.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
    $this->app['laradmin'] = $this->app->share(function($app)
    {
      return new Laradmin;
    });

    \App::register('Beiker\Laradmin\View\ViewServiceProvider');
    \App::register('Beiker\Laradmin\Storage\StorageServiceProvider');

    $this->registerInstallCommand();

    $this->commands('command.laradmin.install');
	}

  /**
   * Registra el commando install.
   *
   * @return void
   */
  protected function registerInstallCommand()
  {
    $this->app['command.laradmin.install'] = $this->app->share(function($app)
    {
      // $creator = $app['laradmin.creator'];

      // $packagePath = $app['path.base'].'/vendor';

      $creator = $this->app->make('Beiker\Laradmin\Console\StubCreator');

      return new LaradminInstallCommand($creator); //$creator, $packagePath
    });
  }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('laradmin');
	}

}