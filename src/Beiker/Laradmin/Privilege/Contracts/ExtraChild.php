<?php namespace Beiker\Laradmin\Privilege\Contracts;

interface ExtraChild {

  /**
   * return the data.
   *
   * @param string $parentId
   * @param string $parentName
   * @param string $parentUrl
   * @return array
   */
  public function getData($parentId, $parentName, $parentUrl);

}