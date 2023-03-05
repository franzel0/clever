<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
    ];
    
    /**
     * Get the post of a comment
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * Get the user of a comment
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
