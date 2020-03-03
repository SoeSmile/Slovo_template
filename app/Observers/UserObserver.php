<?php
declare(strict_types=1);

namespace App\Observers;

use App\Mail\UserConfirmMail;
use App\Models\User;
use Mail;

final class UserObserver extends AbstractObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        Mail::to($user)->queue(new UserConfirmMail($user));

        $this->storeJournal($user, 'createUser');
    }


    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user): void
    {
        $this->storeJournal($user, 'updateUser');
    }


    /**
     * Handle the user "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user): void
    {
        $this->storeJournal($user, 'deleteUser');
    }
}
