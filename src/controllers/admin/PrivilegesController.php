<?php namespace Beiker\Laradmin\Controllers;

use Beiker\Laradmin\Storage\Privilege\PrivilegeRepositoryInterface;
use Beiker\Laradmin\Privilege\TreePrivilegesBuilder;
use Beiker\Laradmin\Privilege\LinkPrivilegeGenerator;
use Illuminate\Routing\Controllers\Controller;

class PrivilegesController extends Controller {

  /**
   * Constructor.
   *
   * @param Beiker\Laradmin\Storage\Privilege\PrivilegeRepositoryInterface $privilege
   * @param Beiker\Laradmin\Privilege\TreePrivilegesBuilder                $treePrivileges
   * @param Beiker\Laradmin\Privilege\LinkPrivilegeGenerator               $linkGenerator
   */
  public function __construct(PrivilegeRepositoryInterface $privilege,
                              TreePrivilegesBuilder $treePrivileges,
                              LinkPrivilegeGenerator $linkGenerator)
  {
    $this->privilege      = $privilege;
    $this->treePrivileges = $treePrivileges;
    $this->linkGenerator  = $linkGenerator;
  }

	/**
	 * Display a list of privileges.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
    $scripts = array(
      \Laradmin::jsDir().'admin/msgbox.js',
    );

    $pagination = $this->privilege->filterList(40);

    $privileges = $pagination['items'];

    $title = trans(\Conf::langPath().'messages.privileges');

    $linkGenerator = $this->linkGenerator;

    \Laradmin::scripts($scripts);

		return \View::make('laradmin::admin.privileges.index')
      ->with(compact('title', 'privileges', 'linkGenerator'));
	}

	/**
	 * Show form to create a new privilege.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
    $styles = array(
      \Laradmin::libsDir().'jquery-treeview/css/jquery.treeview.css',
    );

    $scripts = array(
      \Laradmin::libsDir().'jquery-treeview/scripts/jquery.treeview.js',
      \Laradmin::jsDir().'admin/privileges/create.js',
    );

    $title      = trans(\Conf::langPath().'messages.admin-privilege-create-title');
    $crumbTitle = trans(\Conf::langPath().'messages.add');

    $linkGenerator = $this->linkGenerator;
    $treePrivileges = $this->treePrivileges;

    \Laradmin::styles($styles);
    \Laradmin::scripts($scripts);

		return \View::make('laradmin::admin.privileges.create')
      ->with(compact('title', 'crumbTitle', 'linkGenerator', 'treePrivileges'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
    $validation = new \Validators\Admin\PrivilegesCreate;

    if ($validation->passes())
    {

      $this->privilege->create(\Input::all());

      $noty = \Util::noty(trans(\Conf::langPath().'messages.admin-privilege-create-success'), 'success');

      return \Redirect::route('privileges.create')
        ->with(compact('noty'));
    }

    return \Redirect::route('privileges.create')
      ->withErrors($validation->errors)
      ->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		return 'show ' . $id;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = 0)
	{
		$styles = array(
      \Laradmin::libsDir().'jquery-treeview/css/jquery.treeview.css',
    );

    $scripts = array(
      \Laradmin::libsDir().'jquery-treeview/scripts/jquery.treeview.js',
    );

    $title      = trans(\Conf::langPath().'messages.admin-privilege-edit-title');
    $crumbTitle = trans(\Conf::langPath().'messages.edit');

    $priv = $this->privilege->findOrFail($id, 'withTrashed');

    $linkGenerator = $this->linkGenerator;
    $treePrivileges = $this->treePrivileges;

    \Laradmin::styles($styles);
    \Laradmin::scripts($scripts);

    return \View::make('laradmin::admin.privileges.edit')
      ->with(compact('title', 'crumbTitle', 'priv', 'linkGenerator', 'treePrivileges'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function putUpdate($id)
	{
		$validation = new \Validators\Admin\PrivilegesCreate;

    if ($validation->passes())
    {
      $this->privilege->update($id, \Input::all());

      $noty = \Util::noty(trans(\Conf::langPath().'messages.admin-privilege-update-success'), 'success');

      return \Redirect::route('privileges.edit', array($id))
        ->with(compact('noty'));
    }

    return \Redirect::route('privileges.edit', array($id))
      ->withErrors($validation->errors)
      ->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
    if (! is_null($privilege = $this->privilege->findOrFail($id, 'withTrashed')))
    {
      $notyMsg = trans(\Conf::langPath().'messages.admin-privilege-delete-success');
      $notyIco = 'success';

      $privilege->forceDelete();
    }

    $noty = \Util::noty($notyMsg, $notyIco);

    return \Redirect::route('privileges.index')
      ->with(compact('noty'));
	}

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function getSoftdelete($id)
  {
    $notyMsg = 'El privilegio no existe';
    $notyIco = 'error';

    if ( ! is_null($privilege = $this->privilege->findOrFail($id)))
    {
      $notyMsg = trans(\Conf::langPath().'messages.admin-privilege-softdelete-success');
      $notyIco = 'success';

      $privilege->delete();
      // DBUtil::logAction();
    }

    $noty = \Util::noty($notyMsg, $notyIco);

    return \Redirect::route('privileges.index')
      ->with(compact('noty'));
  }

  /**
   * Restore the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function getRestore($id)
  {
    $notyMsg = 'El privilegio no existe';
    $notyIco = 'error';

    if ( ! is_null($privilege = $this->privilege->findOrFail($id, 'withTrashed')))
    {
      $notyMsg = trans(\Conf::langPath().'messages.admin-privilege-restore-success');
      $notyIco = 'success';

      $privilege->restore();
    }

    $noty = \Util::noty($notyMsg, $notyIco);

    return \Redirect::route('privileges.index')
      ->with(compact('noty'));
  }

}