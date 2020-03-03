<?php
declare(strict_types=1);

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserRegisterMail
 * @package App\Mail
 */
class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;


    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->subject(trans('mail.subject_register'))->view('emails.userRegister');
    }
}
