<?php
namespace App\Services;


use Swift_Mailer;
use Swift_Message;

class Mail
{
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send($email, $body)
    {
        $message = (new Swift_Message('Проект SintezMLM'))
            ->setFrom(['admin@sintezmlm.ru' => 'Посетитель'])
            ->setTo($email)
            ->setBody($body);

        return $this->mailer->send($message);
    }
}