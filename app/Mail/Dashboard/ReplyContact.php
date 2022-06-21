<?php

namespace App\Mail\Dashboard;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyContact extends Mailable
{
    use Queueable, SerializesModels;
    public $reply;
        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($reply)
        {
            $this->reply = $reply;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            $reply = $this->reply;
            return $this->from(setting('email'))->view('dashboard.email.reply_contact',compact('reply'))->subject(trans('dashboard.email.reply_contact'));
        }
}
