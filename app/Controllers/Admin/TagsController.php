<?php
namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;

class TagsController extends Controller
{
    public function index()
    {
        $tags = $this->database->all('tags');

        echo $this->view->render('admin/tags/index', ['tags' =>  $tags]);


    }


    public function create()
    {
        echo $this->view->render('admin/tags/create');
    }


    public function store()
    {
        $validator = v::key('title', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название'
        ]);
        $_POST['slug'] = slug($_POST['title']);
        $this->database->create('tags', $_POST);

        return redirect('/admin/tags');
    }




    public function edit($id)
    {
        $tags = $this->database->find('tags', $id);
        echo $this->view->render('admin/tags/edit', ['tags' =>  $tags]);
    }

    public function update($id)
    {
        $validator = v::key('title', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название'
        ]);
        $_POST['slug'] = slug($_POST['title']);
        $this->database->update('tags', $id, $_POST);

        return redirect('/admin/tags');
    }

    public function delete($id)
    {
        $this->database->delete('tags', $id);
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