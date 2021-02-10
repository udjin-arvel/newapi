<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Story;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoryPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the story.
     *
     * @param User $user
     * @param Story $story
     * @return mixed
     */
    public function view(User $user, Story $story): bool
    {
        return $user->isUserWithRights();
    }

    /**
     * Determine whether the user can create stories.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return $user->isUserWithRights();
    }

    /**
     * Determine whether the user can update the story.
     *
     * @param  User  $user
     * @param  Story  $story
     * @return mixed
     */
    public function update(User $user, Story $story): bool
    {
        return $user->isUserWithRights() && $user->id === $story->user_id;
    }
    
    /**
     * Determine whether the user can delete the story.
     *
     * @param User $user
     * @param Story $story
     * @return mixed
     */
    public function delete(User $user, Story $story): bool
    {
        return $user->isUserWithRights() && $user->id === $story->user_id;
    }
}
