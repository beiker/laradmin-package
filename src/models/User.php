<?php namespace Beiker\Laradmin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

  /**
   * Model use softDelete.
   *
   * @var string
   */
  protected $softDelete = true;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

  /*
   |------------------------------------------------------------------------
   | Relations
   |------------------------------------------------------------------------
   */

  /**
   * Relation many to many with privileges.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function privileges()
  {
    return $this->belongsToMany('Beiker\Laradmin\Models\Privilege');
  }

  /*
   |------------------------------------------------------------------------
   | Mutators
   |------------------------------------------------------------------------
   */
  public function setPasswordAttribute($value)
  {
    if ($value !== '')
    {
      $this->attributes['password'] = \Hash::make($value);
    }
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

}