<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Traits\CommonFunction;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

/**
 * @author Vahid Mohammadi
 * Class PostPolicy
 * @package App\Policies
 */
class PostPolicy
{
    use HandlesAuthorization;
    use CommonFunction;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if (Str::contains($this->GetPermission('Post', $user->id), '2'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (Str::contains($this->GetPermission('Post', $user->id), '1'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if (Str::contains($this->GetPermission('Post', $user->id), '3')) {

            return $user->id === $post->user_id;
        }
        else
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if (Str::contains($this->GetPermission('Post', $user->id), '4'))
                return $user->id === $post->user_id;
        else
            return false;
    }

}
