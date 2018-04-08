<?php

namespace LANMS;

use Cartalyst\Sentinel\Permissions\PermissibleInterface;
use Cartalyst\Sentinel\Permissions\PermissibleTrait;
use Cartalyst\Sentinel\Persistences\PersistableInterface;
use Cartalyst\Sentinel\Roles\RoleableInterface;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Database\Eloquent\Model;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class User extends Model implements RoleableInterface, PermissibleInterface, PersistableInterface, UserInterface
{
	use PermissibleTrait;

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'users';

	/**
	 * {@inheritDoc}
	 */
	protected $fillable = [
		'uid',
		'email',
		'username',
		'password',
		'lastname',
		'firstname',
		'permissions',
		'referral',
		'referral_code',
		'last_activity',
		'birthdate',
		'gender',
		'occupation',
		'location',
		'profilepicture',
		'profilepicturesmall',
		'profilecover',
		'showemail',
		'showname',
		'showonline',
		'userdateformat',
		'usertimeformat',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $persistableKey = 'user_id';

	/**
	 * {@inheritDoc}
	 */
	protected $persistableRelationship = 'persistences';

	/**
	 * Array of login column names.
	 *
	 * @var array
	 */
	protected $loginNames = ['email', 'username'];

	/**
	 * The Eloquent roles model name.
	 *
	 * @var string
	 */
	protected static $rolesModel = 'Cartalyst\Sentinel\Roles\EloquentRole';

	/**
	 * The Eloquent persistences model name.
	 *
	 * @var string
	 */
	protected static $persistencesModel = 'Cartalyst\Sentinel\Persistences\EloquentPersistence';

	/**
	 * The Eloquent activations model name.
	 *
	 * @var string
	 */
	protected static $activationsModel = 'Cartalyst\Sentinel\Activations\EloquentActivation';

	/**
	 * The Eloquent reminders model name.
	 *
	 * @var string
	 */
	protected static $remindersModel = 'Cartalyst\Sentinel\Reminders\EloquentReminder';

	/**
	 * The Eloquent throttling model name.
	 *
	 * @var string
	 */
	protected static $throttlingModel = 'Cartalyst\Sentinel\Throttling\EloquentThrottle';

	/**
	 * Returns an array of login column names.
	 *
	 * @return array
	 */
	public function getLoginNames()
	{
		return $this->loginNames;
	}

	/**
	 * Returns the roles relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles()
	{
		return $this->belongsToMany(static::$rolesModel, 'role_users', 'user_id', 'role_id')->withTimestamps();
	}

	/**
	 * Returns the persistences relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function persistences()
	{
		return $this->hasMany(static::$persistencesModel, 'user_id');
	}

	/**
	 * Returns the activations relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function activations()
	{
		return $this->hasMany(static::$activationsModel, 'user_id');
	}

	/**
	 * Returns the reminders relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function reminders()
	{
		return $this->hasMany(static::$remindersModel, 'user_id');
	}

	/**
	 * Returns the throttle relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function throttle()
	{
		return $this->hasMany(static::$throttlingModel, 'user_id');
	}

	/**
	 * Get mutator for the "permissions" attribute.
	 *
	 * @param  mixed  $permissions
	 * @return array
	 */
	public function getPermissionsAttribute($permissions)
	{
		return $permissions ? json_decode($permissions, true) : [];
	}

	/**
	 * Set mutator for the "permissions" attribute.
	 *
	 * @param  mixed  $permissions
	 * @return void
	 */
	public function setPermissionsAttribute(array $permissions)
	{
		$this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getRoles()
	{
		return $this->roles;
	}

	/**
	 * {@inheritDoc}
	 */
	public function inRole($role)
	{
		if ($role instanceof RoleInterface) {
			$roleId = $role->getRoleId();
		}

		foreach ($this->roles as $instance) {
			if ($role instanceof RoleInterface) {
				if ($instance->getRoleId() === $roleId) {
					return true;
				}
			} else {
				if ($instance->getRoleId() == $role || $instance->getRoleSlug() == $role) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function generatePersistenceCode()
	{
		return str_random(32);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUserId()
	{
		return $this->getKey();
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPersistableId()
	{
		return $this->getKey();
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPersistableKey()
	{
		return $this->persistableKey;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setPersistableKey($key)
	{
		$this->persistableKey = $key;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setPersistableRelationship($persistableRelationship)
	{
		$this->persistableRelationship = $persistableRelationship;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPersistableRelationship()
	{
		return $this->persistableRelationship;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUserLogin()
	{
		return $this->getAttribute($this->getUserLoginName());
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUserLoginName()
	{
		return reset($this->loginNames);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUserPassword()
	{
		return $this->password;
	}

	/**
	 * Returns the roles model.
	 *
	 * @return string
	 */
	public static function getRolesModel()
	{
		return static::$rolesModel;
	}

	/**
	 * Sets the roles model.
	 *
	 * @param  string  $rolesModel
	 * @return void
	 */
	public static function setRolesModel($rolesModel)
	{
		static::$rolesModel = $rolesModel;
	}

	/**
	 * Returns the persistences model.
	 *
	 * @return string
	 */
	public static function getPersistencesModel()
	{
		return static::$persistencesModel;
	}

	/**
	 * Sets the persistences model.
	 *
	 * @param  string  $persistencesModel
	 * @return void
	 */
	public static function setPersistencesModel($persistencesModel)
	{
		static::$persistencesModel = $persistencesModel;
	}

	/**
	 * Returns the activations model.
	 *
	 * @return string
	 */
	public static function getActivationsModel()
	{
		return static::$activationsModel;
	}

	/**
	 * Sets the activations model.
	 *
	 * @param  string  $activationsModel
	 * @return void
	 */
	public static function setActivationsModel($activationsModel)
	{
		static::$activationsModel = $activationsModel;
	}

	/**
	 * Returns the reminders model.
	 *
	 * @return string
	 */
	public static function getRemindersModel()
	{
		return static::$remindersModel;
	}

	/**
	 * Sets the reminders model.
	 *
	 * @param  string  $remindersModel
	 * @return void
	 */
	public static function setRemindersModel($remindersModel)
	{
		static::$remindersModel = $remindersModel;
	}

	/**
	 * Returns the throttling model.
	 *
	 * @return string
	 */
	public static function getThrottlingModel()
	{
		return static::$throttlingModel;
	}

	/**
	 * Sets the throttling model.
	 *
	 * @param  string  $throttlingModel
	 * @return void
	 */
	public static function setThrottlingModel($throttlingModel)
	{
		static::$throttlingModel = $throttlingModel;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete()
	{
		$isSoftDeleted = array_key_exists('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this));

		if ($this->exists && ! $isSoftDeleted) {
			$this->activations()->delete();
			$this->persistences()->delete();
			$this->reminders()->delete();
			$this->roles()->detach();
			$this->throttle()->delete();
		}

		return parent::delete();
	}

	/**
	 * Dynamically pass missing methods to the user.
	 *
	 * @param  string  $method
	 * @param  array  $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		$methods = ['hasAccess', 'hasAnyAccess'];

		if (in_array($method, $methods)) {
			$permissions = $this->getPermissionsInstance();

			return call_user_func_array([$permissions, $method], $parameters);
		}

		return parent::__call($method, $parameters);
	}

	/**
	 * Creates a permissions object.
	 *
	 * @return \Cartalyst\Sentinel\Permissions\PermissionsInterface
	 */
	protected function createPermissions()
	{
		$userPermissions = $this->permissions;

		$rolePermissions = [];

		foreach ($this->roles as $role) {
			$rolePermissions[] = $role->permissions;
		}

		return new static::$permissionsClass($userPermissions, $rolePermissions);
	}

	public function addresses() {
		return $this->hasMany('Address', 'user_id');
	}

	public function reservations() {
		return $this->hasMany('SeatReservation', 'reservedby_id', 'id');
	}

	public function ownReservations() {
		return $this->hasMany('SeatReservation', 'reservedfor_id', 'id');
	}

	public function reservationsThisYear() {
		return $this->hasMany('SeatReservation', 'reservedby_id', 'id')->thisYear();
	}

	public function ownReservationsThisYear() {
		return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->thisYear();
	}

	public function ownReservationsThisYearDecending() {
		return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->thisYearDecending();
	}

	public function reservationsLastYear() {
		return $this->hasMany('SeatReservation', 'reservedby_id', 'id')->lastYear();
	}

	public function ownReservationsLastYear() {
		return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->lastYear();
	}

	public function ownReservationsLastYearDecending() {
		return $this->hasMany('SeatReservation', 'reservedfor_id', 'id')->lastYearDecending();
	}

	function stripecustomer() {
		return $this->hasOne('LANMS\StripeCustomer', 'user_id', 'id');
	}

	function seatpayments() {
		return $this->hasMany('LANMS\SeatPayment', 'user_id', 'id');
	}

	public function scopeGetLastActivity($query, $id, $short = false) {

		$user 		= $query->where('id', '=', $id)->first();
		$time 		= $user->last_activity;

		$SECOND 	= 1;
		$MINUTE 	= 60 * $SECOND;
		$HOUR 		= 60 * $MINUTE;
		$DAY 		= 24 * $HOUR;
		$MONTH 		= 30 * $DAY;
		$before 	= time() - strtotime($time);

		if ($before < 0) {
			return "not yet";
		}

		if ($time == '0000-00-00 00:00:00') {
			return "never";
		}

		if ($short) {

			if ($before < 1 * $MINUTE) {
				return ($before <5) ? "just now" : $before . " ago";
			}

			if ($before < 2 * $MINUTE) {
				return "1m ago";
			}

			if ($before < 45 * $MINUTE) {
				return floor($before / 60) . "m ago";
			}

			if ($before < 90 * $MINUTE) {
				return "1h ago";
			}

			if ($before < 24 * $HOUR) {
				return floor($before / 60 / 60). "h ago";
			}

			if ($before < 48 * $HOUR) {
				return "1d ago";
			}

			if ($before < 30 * $DAY) {
				return floor($before / 60 / 60 / 24) . "d ago";
			}

			if ($before < 12 * $MONTH) {
				$months = floor($before / 60 / 60 / 24 / 30);
				return $months <= 1 ? "1mo ago" : $months . "mo ago";
			} else {
				$years = floor  ($before / 60 / 60 / 24 / 30 / 12);
				return $years <= 1 ? "1y ago" : $years."y ago";
			}

		}

		if ($before < 1 * $MINUTE) {
			return ($before <= 1) ? "just now" : $before . " seconds ago";
		}

		if ($before < 2 * $MINUTE) {
			return "a minute ago";
		}

		if ($before < 45 * $MINUTE) {
			return floor($before / 60) . " minutes ago";
		}

		if ($before < 90 * $MINUTE) {
			return "an hour ago";
		}

		if ($before < 24 * $HOUR) {
			return (floor($before / 60 / 60) == 1 ? 'about an hour' : floor($before / 60 / 60).' hours'). " ago";
		}

		if ($before < 48 * $HOUR) {
			return "yesterday";
		}

		if ($before < 30 * $DAY) {
			return floor($before / 60 / 60 / 24) . " days ago";
		}

		if ($before < 12 * $MONTH) {
			$months = floor($before / 60 / 60 / 24 / 30);
			return $months <= 1 ? "one month ago" : $months . " months ago";
		} else {
			$years = floor  ($before / 60 / 60 / 24 / 30 / 12);
			return $years <= 1 ? "one year ago" : $years." years ago";
		}

	}

	public function scopeGetOnlineStatus($query, $id) {

		$user 		= $query->where('id', '=', $id)->first();
		$time 		= $user->last_activity;

		$SECOND 	= 1;
		$MINUTE 	= 60 * $SECOND;
		$before 	= time() - strtotime($time);

		if ($time == "0000-00-00 00:00:00") {
			return "offline";
		}

		if ($before < 5 * $MINUTE) {
			return "online";
		} elseif ($before < 10 * $MINUTE) {
			return "idle";
		} else {
			return "offline";
		}

	}

	public function scopeGetUserDateFormat($query) {

		if(Sentinel::check()) {
			$user 		= $query->where('id', '=', Sentinel::getUser()->id)->first();
			$format 	= $user->userdateformat;

			if($format == null) {
				$format = 'd. M Y';
			}

		} else {
			$format = 'd. M Y';
		}

		return $format;
	}

	public function scopeGetUserTimeFormat($query) {

		if(Sentinel::check()) {
			$user 		= $query->where('id', '=', Sentinel::getUser()->id)->first();
			$format 	= $user->usertimeformat;

			if($format == null) {
				$format = 'H:i';
			}

		} else {
			$format = 'H:i';
		}

		return $format;
	}
	
	public function scopeGetFullnameByID($query, $id) {
		$user = $query->where('id', '=', $id)->first();
		if($user->showname) {
			return $user->firstname . ' ' . $user->lastname;
		} else {
			return $user->firstname;
		}
	}

	public function scopeGetUsernameAndFullnameByID($query, $id) {
		$user = $query->where('id', '=', $id)->first();
		if($user->showname) {
			return $user->username . ' (' . $user->firstname . ' ' . $user->lastname . ')';
		} else {
			return $user->username . ' (' . $user->firstname . ')';
		}
		
	}

	public function scopeGetFullnameAndNicknameByID($query, $id) {
		$user = $query->where('id', '=', $id)->first();
		if($user->showname) {
			return $user->firstname . ' "' . $user->username . '" ' . $user->lastname;
		} else {
			return $user->firstname . ' "' . $user->username . '"';
		}
		
	}

	public function age() {
		return \Carbon::parse($this->birthdate)->diff(\Carbon::now())->format('%y');
	}

	public function scopeGetGenderIcon($query, $gender) {
		switch ($gender) {
			case 'Male':
				return "mars";
			case 'Female':
				return "venus";
			case 'Transgender':
				return "transgender";
			case 'Genderless':
				return "genderless";
			default:
				return "genderless";
		}
	}

}
