<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * Get the posts with the status.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
