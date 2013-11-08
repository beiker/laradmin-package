<?php namespace Beiker\Laradmin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Privilege extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'privileges';

  /**
   * Model with softDelete.
   *
   * @var string
   */
  protected $softDelete = true;

  /**
   * Appends.
   *
   * @var string
   */
  protected $appends = array('langName');

  /*
   |------------------------------------------------------------------------
   | Relations
   |------------------------------------------------------------------------
   */

  /**
   * Relation many to many with users.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function users()
  {
    return $this->belongsToMany('Beiker\Laradmin\Models\User');
  }

  /**
   * Relation one to many with Privileges.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function childs()
  {
    return $this->hasMany('Beiker\Laradmin\Models\Privilege', 'parent_id');
  }

  /*
   |------------------------------------------------------------------------
   | Mutators
   |------------------------------------------------------------------------
   */

  public function setUrlActionAttribute($value)
  {
    if (ends_with($value, '/'))
    {
      $value = substr($value, 0, -1);
    }
    $this->attributes['url_action'] = strtolower($value);
  }

  /*
   |------------------------------------------------------------------------
   | Accesors
   |------------------------------------------------------------------------
   */

  public function getCreatedAtAttribute($value)
  {
    return substr($value, 0, 10);
  }

  /*
   |------------------------------------------------------------------------
   | Appends
   |------------------------------------------------------------------------
   */
  public function getLangNameAttribute()
  {
    return trans(\Conf::langPath().$this->attributes['lang']);
  }
}
