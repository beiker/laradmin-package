<?php namespace Beiker\Laradmin\Storage\User;

interface UserRepositoryInterface {

  /**
   * Find a resource.
   *
   * @return \Illuminate\Database\Eloquent\Model|Collection
   */
  public function findOrFail($id);

  /**
   * Return all models with relations.
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all($relations = null);

  /**
   * Create a new user.
   *
   * @param  array $data
   * @return User
   */
  public function create($data);

  /**
   * Update a user.
   *
   * @param  array $data
   * @return User
   */
  public function update($id, $data);

  /**
   * Get the list of users filtering by name|user|status.
   *
   * @param  string $pagination
   * @return array
   */
  public function filterList($perPage = null);

}