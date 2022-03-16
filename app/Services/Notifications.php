<?php
namespace App\Services;



class Notifications
{
    private $mailer;

    public function __construct(Mail $mailer)
    {
        $this->mailer = $mailer;
    }

    public function emailWasChanged($email, $selector, $token)
    {
        //Используем $email для отправки вместо gtestovik39@gmail.com
        $message = 'http://sintezmlm/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
        $this->mailer->send($email, $message); // используем вместо gtestovik39@gmail.com
    }

    public function passwordReset($email, $selector, $token)
    {
        //Используем $email для отправки вместо gtestovik39@gmail.com
        $message = 'http://sintezmlm/password-recovery/form?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
        $this->mailer->send($email, $message); // используем вместо gtestovik39@gmail.com
    }

    public function sendContact($name, $email_user=null, $title, $body)
    {
            // Create the message
        $email = 'nickon_job@rambler.ru';
        $message ="Имя:$name.
                   email:$email_user.
                   Тема:$title.
                   Сообщение:$body";

        $this->mailer->send($email, $message);
    }
}