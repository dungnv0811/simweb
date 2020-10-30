<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class BaseEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var mixed
     */
    private $mailAddress;
    /**
     * @var string|null
     */
    private $mailName;

    /**
     * @param string|null $mailAddress
     * @return BaseEmail
     */
    public function setMailAddress(?string $mailAddress)
    {
        $this->mailAddress = $mailAddress;
        return $this;
    }

    /**
     * @param string|null $mailName
     * @return $this
     */
    public function setMailName(?string $mailName)
    {
        $this->mailName = $mailName;
        return $this;
    }

    /**
     * Get address email
     */
    public function getMailAddress(): string
    {
        if ($this->mailAddress) {
            return $this->mailAddress;
        }
        return config('mail.from.address');
    }

    /**
     * @return string
     */
    public function getMailName(): string
    {
        if ($this->mailName) {
            return $this->mailName;
        }
        return config('mail.from.name');
    }

}
