<?php

namespace Modules\Institute\Policies\Information;

use App\Models\Institute\Information\Video;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Video $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Video $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Video $video)
    {
        return session()->get('institute.id') === $video->institute_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Video $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Video $video)
    {
        return session()->get('institute.id') === $video->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can delete the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Video $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Video $video)
    {
        return session()->get('institute.id') === $video->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can restore the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Video $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Video $video)
    {
        return session()->get('institute.id') === $video->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can permanently delete the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Video $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Video $video)
    {
        return session()->get('institute.id') === $video->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }
}
