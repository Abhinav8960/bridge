<?php

namespace Modules\Institute\Policies\Information;

use App\Models\Institute;
use App\Models\Institute\Information\Center;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CenterPolicy
{
    use HandlesAuthorization;


     /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        return true;
    }
    /**
     * Determine whether the user can view the model.
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User  $user,Center $center)
    {
        return session()->get('institute.id') == $center->institute_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        $institute =  Institute::findOrFail(session()->get('institute.id'));
        return $institute->package->no_of_centers > $institute->centers->count();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User  $user,Center $center)
    {

        return session()->get('institute.id') == $center->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User  $user,Center $center)
    {
        return session()->get('institute.id') == $center->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User  $user,Center $center)
    {
        return session()->get('institute.id') == $center->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User  $user,Center $center)
    {
        return session()->get('institute.id') == $center->institute_id ? Response::allow() : Response::denyWithStatus(404);
    }
}
