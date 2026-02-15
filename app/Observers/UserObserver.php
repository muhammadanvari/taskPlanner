<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Morilog\Jalali\Jalalian;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Task::create([
            'user_id'=>$user->id,
            'title'=>'ایجاد اولین تسک',
            'due_date'=>Jalalian::now()->format('Y/m/d'),
        ]);
        Category::create([
            'user_id'=>$user->id,
            'name'=>'مطالعه',
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
