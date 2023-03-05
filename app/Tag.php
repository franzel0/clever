<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
    * Get the posts with this tag
    *
    * @var array
    */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    /**
    * Get the posts with this tag
    *
    * @var array
    */
    public function visiblePosts()
    {
        return $this->belongsToMany('App\Post')->where('posts.status_id', 4);
    }
}
