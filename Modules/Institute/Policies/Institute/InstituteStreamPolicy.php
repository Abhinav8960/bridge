<?php

namespace Modules\Institute\Policies\Institute;

use App\Models\Institute;
use App\Models\Institute\InstituteStream;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstituteStreamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;

        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\InstituteStream  $instituteStream
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InstituteStream $instituteStream)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        $institute =  Institute::findOrFail(session()->get('institute.id'));
        return $institute->package->no_of_streams > $institute->streams()->where('status',true)->count();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\InstituteStream  $instituteStream
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function update(User $user, InstituteStream $instituteStream)
    public function update(User $user, InstituteStream  $instituteStream)
    {
        return true;
        
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\InstituteStream  $instituteStream
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InstituteStream $instituteStream)
    {
        return true;
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\InstituteStream  $instituteStream
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InstituteStream $instituteStream)
    {
        return true;
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Institute\InstituteStream  $instituteStream
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InstituteStream $instituteStream)
    {
        return true;
    }
}
