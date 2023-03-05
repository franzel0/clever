<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /*
    * Determine wheter the user can edit the Post
    */
    public function edit(User $user, Post $post)
    {
        // Either the user owns the post or the user is a publisher or admin und has the same section
        return $user->id === $post->user_id || ($user->role_id < 3 && $user->section_id === $post->section_id);
    }

    /*
    * Determine wheter the post is visbile and the user can edit the Post
    */
    public function isVisible(User $user, Post $post)
    {
        // determines if the post is visible = published
        return $post->status_id === 4;
    }

    /*
    * Determines whetere the user owns the Post
    */
    public function own(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /*
    * Determine wheter the user can publish the Post
    */
    public function publish(User $user)
    {
        return true; //$user->section_id === $post->section_id && $user->role_id < 3 ;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        //
    }
}
