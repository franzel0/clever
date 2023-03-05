<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstname', 'lastname', 'email', 'phone', 'password', 'role_id', 'active', 'section_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the posts for the User.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the posts for the User.
     */
    public function visiblePosts()
    {
        return $this->hasMany('App\Post')->where('posts.status_id', 4);
    }

    /**
     * Get the comments of the User.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the seetion of the User.
     */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    /**
     * Get the role of the User.
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
