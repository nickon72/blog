<?php

namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;


class SubscribersController extends Controller
{

    public function index()
    {
        $subs = $this->database->all('subscriptions');

        echo $this->view->render('admin/subs/index', ['subs' =>  $subs]);

    }


    public function create()
    {
        echo $this->view->render('admin/subs/create');
    }



    public function store()
    {
        $validator = v::key('email', v::stringType()->notEmpty())
                      ->key('email',v::email());
        $this->validate($validator, $_POST, [
            'email'   =>  'Заполните поле Название'
        ]);

        $this->database->create('subscriptions', $_POST);

        return redirect('/admin/subs');


    }




    public function delete($id)
    {
        $this->database->delete('Subscriptions', $id);
        return back();
    }

    private function validate($validator, $data, $message)
    {
        try {
            $validator->assert($data);

        } catch (ValidationException $exception) {
            $exception->findMessages($message);
            flash()->error($exception->getMessages());

            return back();
        }
    }



}
