<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny() // index
    {
        // return $admin->hasPermissionTo('Index Admin')
        // ? $this->allow()
        // : $this->deny('This is Cant Make Index Admin');

        if(auth('admin')->check()){
            return auth()->user()->hasPermissionTo('Index Admin')
            ?  $this->allow()
            : $this->deny(' can not open Index-Admin');
        }
        elseif(auth('admin')->check()){
            return auth()->user()->hasPermissionTo('Index City')
            ?  $this->allow()
            : $this->deny(' can not open Index-Admin');
        }
        elseif(auth('author')->check()){
            return auth()->user()->hasPermissionTo('Index Author')
            ?  $this->allow()
            : $this->deny(' can not open Index-Author');
        }
        else
        {
        return  auth()->user()->hasPermissionTo('Index Admin')
            ?  $this->allow()
            : $this->deny(' can not open Index-Admin');
        }
    }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Admin $admin)//show
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()//create
    {
        // return $admin->hasPermissionTo('Create Admin')
        // ? $this->allow()
        // : $this->deny('This is Cant Make Create Admin');

        if(auth('admin')->check()){
            return auth()->user()->hasPermissionTo('Create Admin')
            ?  $this->allow()
            : $this->deny(' can not open Index-Admin');
        }
        elseif(auth('author')->check()){
            return auth()->user()->hasPermissionTo('Create Admin')
            ?  $this->allow()
            : $this->deny(' can not open Index-Author');
        }
        else
        {
        return  auth()->user()->hasPermissionTo('Create Admin')
            ?  $this->allow()
            : $this->deny(' can not open Index-Admin');
        }

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Admin $admin)//edit
    {

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Admin $admin)//distroy
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Admin $admin)//استرجاع
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Admin $admin)//حذف بشكل نهائي
    {
        //
    }
}
