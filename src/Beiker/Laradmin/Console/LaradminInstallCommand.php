<?php namespace Beiker\Laradmin\Console;

use Beiker\Laradmin\Console\StubCreator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Command as Cmd;

class LaradminInstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'laradmin:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install config files, assets, lang, etc...';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(StubCreator $creator)
	{
    $this->creator = $creator;

		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->line('Installing...');

    $this->database();
    $this->routes();
    $this->config();
    $this->lang();
    $this->assets();
    $this->examples();

    $this->info('Complete :) !!!');
	}

  private function database()
  {
    // Si la option --database se especifico entonces crea las tablas y seeds.
    if ($this->option('database'))
    {
      $this->info('Creating Tables...');
      $cmd = array('--package' => 'beiker/laradmin');

      if ($env = $this->option('envi'))
      {
        $cmd['--env'] = $env;
      }

      $this->call('migrate', $cmd);

      $this->info('Creating Seeds...');
      $cmd = array('--class' => 'LaradminDatabaseSeeder');

      if ($env = $this->option('envi'))
      {
        $cmd['--env'] = $env;
      }

      $this->call('db:seed', $cmd);
    }
  }

  private function routes()
  {
    if ($this->createRoutes())
    {
      $this->line('Publishing routes in app/routes.php');
    }
  }

  private function config()
  {
    $this->line('Publishing config files...');
    Cmd::call("config:publish", ["package" => "beiker/laradmin"]); //,  "--path" => "workbench/beiker/laradmin/src/config"
  }

  private function lang()
  {
    $this->line('Publishing "en" and "es" lang files...');
    $this->createLangFiles();
  }

  private function assets()
  {
    $this->line('Publishing assets...');
    Cmd::call('asset:publish', ['package' => 'beiker/laradmin']); //, '--bench' => 'beiker/laradmin'
  }

  private function examples()
  {
    // Si se especifico la opcion --examples entonces inserta los privilegios de los
    // ejemplos, se los asigna al usuario admin y crea los archivos(controller, views).
    if ($this->option('examples'))
    {
      $this->info('Creating Examples Privileges...');
      $cmd = array('--class' => 'LaradminDatabaseExamplesSeeder');

      if ($env = $this->option('envi'))
      {
        $cmd['--env'] = $env;
      }

      $this->call('db:seed', $cmd);

      $this->info('Publishing Examples Files...');
      $this->createExamples();
    }
  }

  /**
   * Copia el contenido del stub routes a app/routes.php
   *
   * @return void
   */
  public function createRoutes()
  {
    $pathDest = $this->laravel['path.base'].'/app';

    return $this->creator->routes($pathDest);
  }

  /**
   * Copia los archivos de lang.
   *
   * @return void
   */
  public function createLangFiles()
  {
    $pathDest = $this->laravel['path.base'].'/app/lang';

    $this->creator->lang($pathDest);
  }

  /**
   * Copia el archivo de ejemplo Reports.
   *
   * @return void
   */
  public function createExamples()
  {
    $pathDest = $this->laravel['path.base'].'/app';

    $this->creator->examples($pathDest);
  }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
	// 	);
	// }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
      array('database', null, InputOption::VALUE_NONE, 'Create all migrations and seeds.', null),
			array('envi', null, InputOption::VALUE_REQUIRED, 'The environment the migrations and seeds should run.', null),
      array('examples', null, InputOption::VALUE_NONE, 'Publish examples controller, views.', null),
		);
	}

}