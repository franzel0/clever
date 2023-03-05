<?php

namespace App;

use Illuminate\Database\Eloquent\Model;use Tag;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'published', 'public', 'section_id', 'status_id',
    ];
    /**
     * Get the user of a post
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the tags of a post
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Get the section of a post
     */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    /**
     * Get the comments of a post
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the status of a post.
     */
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    /**
     * Get the visible posts
     */
     public function scopeVisible($query)
     {
         return $query->where('status_id', 4)
                      ->where(function ($query){
                          $query->where('public',1)
                                ->orwhere('section_id', \Auth::User()->section_id);
                      });
     }

     /**
      * Get the unpublished Posts
      */
      public function scopeUnpublished($query)
      {
          return $query->where('status_id', '<', 3)
                       ->where('user_id', \Auth::User()->id);
      }

     /**
      * check if post is published
      */
      public function scopeIsPublished()
      {
          return $this->status_id == 4;
      }

      /**
      * Get the Posts to be published
      */
      public function scopeTobepublished($query)
      {
          return $query->where('status_id', 3)
                       ->where('section_id', \Auth::User()->section_id);
      }

      /**
       *  sync tags
       */
      public function syncTags($tags)
      {
        foreach ($tags as $key => $tag) {
            if(!ctype_digit($tag)){
                $newTag = \App\Tag::create([
                    'name' => $tag,
                ]);
                unset($tags[$key]);
                $tags[] = $newTag->id;
            }
        }; dd($tags);
        $this->tags()->sync($tags);
        return true;

      }
}
