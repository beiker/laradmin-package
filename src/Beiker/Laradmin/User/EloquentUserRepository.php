<?php namespace Beiker\Laradmin\Storage\User;

use Beiker\Laradmin\Models\User;
use Libs\Upload;

class EloquentUserRepository implements UserRepositoryInterface {

  /**
   * Contructor.
   *
   * @param Libs\Upload $upload
   */
  public function __construct(Upload $upload)
  {
    $this->upload = $upload;
  }

  /**
   * Find a user.
   *
   * @param  string $id
   * @param  string $constraint
   * @return \Illuminate\Database\Eloquent\Model|Collection
   */
  public function findOrFail($id, $constraint = null)
  {
    return is_null($constraint) ? User::findOrFail($id) : User::{$constraint}()->findOrFail($id);
  }

  /**
   * Return all models with relations.
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all($relations = null)
  {
    return is_null($relations) ? User::all() : User::with($relations)->get();
  }

  /**
   * Get the list of users filtering by name|user|status.
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
      $query = User::{$constraint}()->orderBy('name');
    }
    else
    {
      $query = User::orderBy('name'); // ACTIVOS
    }

    if (\Input::has('filter'))
    {
      $query = $query->whereRaw("
        lower(name) LIKE '%".mb_strtolower(\Input::get('filter'))."%' OR
        lower(user) LIKE '%".mb_strtolower(\Input::get('filter'))."%'");
    }

    if ($perPage) $result = \Pagination::setup($query, $perPage);

    else $result['items'] = $query->get();

    return $result;
  }

  /**
   * Create a new user.
   *
   * @param  array $data
   * @return User
   */
  public function create($data)
  {
    $user = new User;

    $this->builderData($user, $data);

    $user->avatar = $this->uploadAvatar($data);
    $user->created_at = new \Datetime;

    $user->save();

    if (isset($data['privileges']))
    {
      $user->privileges()->sync($data['privileges']);
    }

    return $user;
  }

  /**
   * Update a user.
   *
   * @param  array $data
   * @return User
   */
  public function update($id, $data)
  {
    $user = $this->findOrFail($id);

    $user->updated_at = new \Datetime;

    $this->builderData($user, $data);

    // If the avatar was send.
    if ( ! is_null($data['avatar']))
    {
      // If the user has an avatar then delete it.
      if ( ! is_null($user->avatar))
      {
        \File::delete($user->avatar);
      }

      $user->avatar = $this->uploadAvatar($data);
    }

    // If privileges are selected.
    if (isset($data['privileges']))
    {
      $user->privileges()->sync($data['privileges']);
    }

    // Update user and his relations.
    $user->push();

    return $user;
  }

  /**
   * Make the upload of an avatar.
   *
   * @param  array $data
   * @return mixed
   */
  protected function uploadAvatar($data)
  {
    if ( ! is_null($data['avatar']))
    {
      $this->upload->encrypt_name = true;
      $this->upload->setInputFile('avatar');
      $this->upload->setDestinationPath(\Conf::uploadPath());

      return $this->upload->doUpload();
    }

    return null;
  }

  /**
   * Data builder.
   *
   * @param  User $user
   * @param  array  $data
   * @return void
   */
  public function builderData(&$user, array $data)
  {
    $user->name       = $data['name'];
    $user->user       = $data['user'];
    $user->password   = $data['password'];
    $user->email      = $data['email'];
    $user->type       = $data['type'];
  }

  /**
   * Regresa los privilegios hijos de un privilegio padre que el usuario tenga
   * asignados y que tengan el campo show_menu en 1.
   *
   * @param  string $userId
   * @param  string $submenuId
   * @return array
   */
  public function userPrivParents($userId, $submenuId)
  {
    $user = $this->findOrFail($userId);

    return $user->privileges()
      ->where('parent_id', $submenuId)
      ->where('show_menu', 1)
      ->orderBy('name')
      ->get();
  }
}