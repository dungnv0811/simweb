<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class SendEmailVerification extends BaseEmail
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

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
    public function build()
    {
        $address = $this->getMailAddress();
        $subject = 'Welcome new member';
        $name = $this->user->name;

        return $this->view('users.mail.verify')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with(['name' => $name]);
    }
}
