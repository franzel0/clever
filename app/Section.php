<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * Get the posts with the section.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the users with the section.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
