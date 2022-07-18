<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;
use App\Models\UserDetail;


class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user_detail=new UserDetail;
        $user_detail->user_id=$user->id;
        $user_detail->state_id=1;
        $user_detail->district_id=1;
        $user_detail->save();

    }
    
    public function creating($request)
    {
        $user=User::latest()->first()->value('id');
        $request['password']=Hash::make('password');
        $request['costumer_id']=str_pad(rand(1,10000),3,$user).substr($request->name,0,1);
        $request['meter_id']=str_pad(rand(1,1000000),6,$user);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
