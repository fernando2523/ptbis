<?php

namespace App\Policies;

use App\Models\Barging_generate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BargingGeneratePolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barging_generate  $bargingGenerate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Barging_generate $bargingGenerate)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barging_generate  $bargingGenerate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Barging_generate $bargingGenerate)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barging_generate  $bargingGenerate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Barging_generate $bargingGenerate)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barging_generate  $bargingGenerate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Barging_generate $bargingGenerate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barging_generate  $bargingGenerate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Barging_generate $bargingGenerate)
    {
        //
    }
}
