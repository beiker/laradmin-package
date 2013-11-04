<?php namespace Beiker\Laradmin\Storage\Privilege;

use Beiker\Laradmin\Models\Privilege;
use Beiker\Laradmin\User\LoggedUser;
use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

use Beiker\Laradmin\Privileges\Childs\Create;
use Beiker\Laradmin\Privileges\Childs\Save;
use Beiker\Laradmin\Privileges\Childs\Edit;
use Beiker\Laradmin\Privileges\Childs\Update;
use Beiker\Laradmin\Privileges\Childs\Show;
use Beiker\Laradmin\Privileges\Childs\Softdelete;
use Beiker\Laradmin\Privileges\Childs\Restore;

class EloquentPrivilegeRepository implements PrivilegeRepositoryInterface {

  /**
   * Construct.
   *
   * @param Beiker\Laradmin\User\LoggedUser $loggedUser
   */
  public function __construct(LoggedUser $loggedUser)
  {
    $this->loggedUser = $loggedUser;
  }

  /**
   * Find a resource.
   *
   * @return \Illuminate\Database\Eloquent\Model|Collection
   */
  public function findOrFail($id, $constraint = null)
  {
    return is_null($constraint) ? Privilege::findOrFail($id) : Privilege::{$constraint}()->findOrFail($id);
  }

  /**
   * Return all models.
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all($relations = null)
  {
    return is_null($relations) ? Privilege::all() : Privilege::with($relations)->get();
  }

  /**
   * Get the list of privileges filtering by status|name|url action.
   *
   * @param  string $pagination
   * @return array
   */
  public function filterList($perPage = null)
  {
    $result = array();

    $status = \Input::has('status') ? \Input::get('status') : 't';

    if ($status && $status !== 'e')
    {
      $constraint = $status === 't' ? 'withTrashed' : 'onlyTrashed';
      $query = Privilege::{$constraint}()->orderBy('url_action');
    }
    else
    {
      $query = Privilege::orderBy('url_action'); // ACTIVOS
    }

    if (\Input::has('filter'))
    {
      $query = $query->whereRaw("
        lower(name) LIKE '%".mb_strtolower(\Input::get('filter'))."%' OR
        lower(url_action) LIKE '%".mb_strtolower(\Input::get('filter'))."%'");
    }

    if ($perPage) $result = \Pagination::setup($query, $perPage);

    else $result['items'] = $query->get();

    return $result;
  }

  /**
   * Create a new privilege and his extra actions(if exists).
   *
   * @param  array $data
   * @return Privilege
   */
  public function create($data)
  {
    $privilege = new Privilege;

    $this->builderData($privilege, $data);

    $privilege->created_at   = new \Datetime();

    $privilege->save();

    if (isset($data['extra_actions']))
    {
      $actions = [];

      // Loop extra actions.
      foreach ($data['extra_actions'] as $key => $extAction)
      {
        $class = "Beiker\Laradmin\Privileges\Childs\\".ucfirst($extAction);

        $action = \App::make($class);

        $actions[] = $this->builderDataChild($action, $privilege->lang, $privilege->name, $privilege->url_action);
      }

      // Add Extra privileges.
      $array = $privilege->childs()->createMany($actions);
    }

    return $privilege;
  }

  /**
   * Update a privilege.
   *
   * @param  string $id
   * @param  array $data
   * @return Privilege
   */
  public function update($id, $data)
  {
    $privilege = $this->findOrFail($id, 'withTrashed');

    $this->builderData($privilege, $data);

    $privilege->updated_at = new \Datetime;

    $privilege->update();

    return $privilege;
  }

  /**
   * Get information about extra privileges.
   *
   * @param  Beiker\Laradmin\Privilege\Contracts\ExtraChild $child
   * @param  string     $parentId
   * @param  string     $parentName
   * @param  string     $parentUrl
   * @return array
   */
  protected function builderDataChild(ExtraChild $child, $parentLang, $parentName, $parentUrl)
  {
    $lang = $parentLang !== '' ? explode('.', $parentLang)[1] : '';

    return $child->getData($lang, $parentName, $parentUrl);
  }

  /**
   * Set the data.
   *
   * @param  Privilege $privilege
   * @param  array  $data
   * @return void
   */
  protected function builderData(&$privilege, array $data)
  {
    $privilege->name         = $data['name'];
    $privilege->parent_id    = $data['privileges'];
    $privilege->show_menu    = isset($data['show_menu']) ? $data['show_menu'] : 0;
    $privilege->url_action   = $data['url_action'];
    $privilege->url_icon     = $data['url_icon'];
    $privilege->target_blank = isset($data['target_blank']) ? $data['target_blank'] : 0;
    $privilege->lang         = $data['lang'];
    $privilege->use_lang     = isset($data['use_lang']) ? $data['use_lang'] : 0;
  }

  /**
   * Get the privileges by parent.
   *
   * @param  string $parentId
   * @return Illuminate\Database\Query\Builder
   */
  public function byParent($parentId)
  {
    return Privilege::with(['childs'])->where('parent_id', $parentId)->orderBy("name")->get();
  }

  /**
   * Execute a where.
   *
   * @param  string $parentId
   * @return Illuminate\Database\Query\Builder
   */
  public function whereRaw($sql)
  {
    return Privilege::with('users')->whereRaw($sql);
  }

}