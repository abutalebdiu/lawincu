<?php

namespace SalimHosen\Core\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SalimHosen\Core\Models\Notification;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notification;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Notification $notification, $user)
    {
        $this->notification = $notification;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('core::emails.notification');
    }
}
