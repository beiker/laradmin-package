<?php namespace Beiker\Laradmin\Controllers;

use Illuminate\Routing\Controllers\Controller;

class AdminDashboardController extends Controller {

  /**
   * Show the dashboard.
   *
   * @return View
   */
  public function getIndex()
  {
    $title      = trans(\Conf::langPath().'messages.admin-dash-header-title');
    $crumbTitle = trans(\Conf::langPath().'messages.admin-dash-crumb-title');

    return \View::make('laradmin::admin.general.home')
      ->with(compact('title', 'crumbTitle'));
  }

}