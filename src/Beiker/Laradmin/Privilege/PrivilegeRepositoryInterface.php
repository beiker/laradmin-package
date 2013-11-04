<?php namespace Beiker\Laradmin\Storage\Privilege;

interface PrivilegeRepositoryInterface {

  /**
   * Find a resource.
   *
   * @return \Illuminate\Database\Eloquent\Model|Collection
   */
  public function findOrFail($id);

  /**
   * Return all models.
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all($relations = null);

  /**
   * Create a new privilege.
   *
   * @return Privilege
   */
  public function create($data);

  /**
   * Update a privilege.
   *
   * @param  string $id
   * @param  array $data
   * @return Privilege
   */
  public function update($id, $data);

  /**
   * Get the list of privileges filtering by status|name|url action
   *
   * @return array
   */
  public function filterList($perPage = null);


}