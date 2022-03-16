<?php


namespace App\Controllers;

use App\Services\Mail;
use App\Services\Notifications;
use Delight\Auth\Auth;

class ResendEmailController extends Controller{

    private $notifications;

    public function __construct(Notifications $notifications)
    {
        parent::__construct();
        $this->notifications = $notifications;
    }


    public function resend_email()
    {
        try {
            $email = $_POST['email'];
            $this->auth->resendConfirmationForEmail($email, function ($selector, $token) use($email){
                $this->notifications->emailWasChanged($email, $selector, $token);
            });

            flash()->success(['Пользователь может теперь ответить на запрос подтверждения (обычно, щелкнув ссылку)']);
        }
        catch (\Delight\Auth\ConfirmationRequestNotFound $e) {
            flash()->error(['Более ранний запрос не найден, который может быть повторно отправлен ']);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error(['Запрошено слишком много запросов - повторите попытку позже']);
        }

        return redirect('/login');

    }
} 