<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('email', 'password', 'activated');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Soft Delete adds a deleted_at timestamp on the record
	 *
	 * @var boolean
	 */
	protected $softDelete = true;

    /**
     * Allows the following syntax to be used within tests:
     *     Post::shouldReceive('all')->once();
     *
     * @todo Move this to a 'BaseModel'
     */
    public static function shouldReceive()
    {
        $class = get_called_class();
        $repo = "EveryEquity\\Storage\\{$class}\\{$class}RepositoryInterface";
        $mock = Mockery::mock($repo);

        App::instance($repo, $mock);

        return call_user_func_array(
            [$mock, 'shouldReceive'],
            func_get_args()
        );
    }

	/**
	 * Handle model events
	 * Model events may also be used anywhere else that is auto-loaded.
	 * A model observer could also be used to manage model events.
	 */
	public static function boot()
    {
        parent::boot();

    	/**
         * @todo Make this into a 'creating' event (to run as a transaction).
         *		 -> Can't do this since the User doesn't exist yet...?
         */
        static::created(function($user)
        {
            // Attach a role to this user (Hard coded for now)
            $user->roles()->attach(1);

            // Add an empty profile model for the new user
            $user->profile()->save(new Profile);

            // Add an empty settings model for the new user
            $user->setting()->save(new Setting);

            // Add an empty privacy model for the new user
            $user->setting()->save(new Privacy);
        });
    }

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

    /**
	 * Determine if the user has a given role
	 *
	 * @return boolean
	 */
    public function hasRole($key)
    {
        foreach ($this->roles as $role)
        {
            if ($role->name === $key)
            {
                return true;
            }
        }

        return false;
    }

    /**
	 * One to One relationship with Profile
	 *
	 * @return object
	 */
	public function profile()
    {
        return $this->hasOne('Profile');
    }

    /**
     * One to One relationship with Setting
     *
     * @return object
     */
    public function setting()
    {
        return $this->hasOne('Setting');
    }

    /**
     * One to One relationship with Privacy
     *
     * @return object
     */
    public function privacy()
    {
        return $this->hasOne('Privacy');
    }
    
    /**
	 * Many to Many relationship with Role
	 *
	 * @return object
	 */
	public function roles()
	{
        return $this->belongsToMany('Role');
    }

    /**
	 * Many to Many relationship with Permission
	 *
	 * @return object
	 */
    public function permissions()
    {
        return $this->hasMany('Permission');
    }
}
