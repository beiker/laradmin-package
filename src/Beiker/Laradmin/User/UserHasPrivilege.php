<?php namespace Beiker\Laradmin\User;

use Beiker\Laradmin\Storage\Privilege\PrivilegeRepositoryInterface;

class UserHasPrivilege {

  /**
   * Indicate if information about privilege will be returned.
   *
   * @var boolean
   */
  protected $returnInfo = false;

  /**
   * Constructor.
   *
   * @return void
   */
  function __construct(PrivilegeRepositoryInterface $privilege)
  {
    $this->privilege = $privilege;
  }

  /**
   * Determina si un usuario tiene un privilegio.
   *
   * @return boolean
   */
  public function has()
  {
    if (is_int($this->urlOrId) || intval($this->urlOrId) > 0)
    {
      $raw = "id = " . $this->urlOrId;
    }
    else
    {
      $raw = "lower(url_action) = '".mb_strtolower(str_replace('index/', '', $this->urlOrId)) . "'";
    }

    $privilege = $this->privilege->whereRaw($raw)->get();

    if ($privilege->count() > 0)
    {
      $userHas = $privilege[0]->users->contains($this->userId);

      if ($userHas > 0)
      {
        if($this->returnInfo) return $privilege[0];

        return true;
      }
    }

    return false;
  }

  /**
   * Set Id.
   *
   * @param string $userId
   * @return void
   */
  public function setUserId($userId)
  {
    $this->userId = $userId;
  }

  /**
   * Set the id or url of the action.
   *
   * @param string $urlOrId
   * @return void
   */
  public function setUrlOrId($urlOrId)
  {
    $this->urlOrId = $urlOrId;
  }

  /**
   * Specified if the information of privilege will be returned.
   *
   * @param boolean $returnInfo
   * @return void
   */
  public function setReturnInfo($returnInfo)
  {
    $this->returnInfo = $returnInfo;
  }

}
