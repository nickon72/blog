<?php

namespace App\Controllers;

use App\Services\Mail;
use App\Services\Notifications;
use Phelium\Component\reCAPTCHA;
use Delight\Auth\Auth;

class ContactController extends Controller
{
    private $mailer;
    private $reCAPTCHA;
    private $notifications;

    public function __construct(Mail $mailer, reCAPTCHA $reCAPTCHA, Notifications $notifications)
    {
        parent::__construct();
        $this->mailer = $mailer;
        $this->reCAPTCHA = $reCAPTCHA;
        $this->notifications = $notifications;
        $this->reCAPTCHA->setSiteKey('6LeTRYMUAAAAAF1sS5qZWhunTk_kv2yDN1TLiL_m');
        $this->reCAPTCHA->setSecretKey('6LeTRYMUAAAAAPwz8k6gIn5mJNzmEH_VQ4WeNluQ');
    }

    public function proba()
    {
        echo $this->view->render('contact/proba');
    }


    public function showContact()

    {
        $script = $this->reCAPTCHA->getScript();
        $captcha = $this->reCAPTCHA->getHtml();

        echo $this->view->render('contact/show', ['captcha' => $captcha,'script' => $script]);
    }

    public function postContact()
    {

        try {

            if ($this->reCAPTCHA->isValid($_POST['g-recaptcha-response'])) {
                $this->notifications->sendContact($_POST['name'],$_POST['email_user'],$_POST['title'],$_POST['body']);
                flash()->success(['Ваше сообщение отправлено']);

            } else {

                flash()->error(['каптча не пройдена']);
            }
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            // invalid email address
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            // email not verified
        }

        return back();
    }



} 