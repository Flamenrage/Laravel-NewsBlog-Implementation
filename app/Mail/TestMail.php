<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body) //при создании экземпляра класса -> передача данных для создания письма
    {
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() //представление макета
    {
        return $this->view('test-mail')->attach(url('img/1.jpg')); //вложение в письме
    }
}
