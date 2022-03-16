<?php
namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;

class Categories_blogController extends Controller
{
    public function index()
    {
        $categories_blog = $this->database->all('categories_blog');

        echo $this->view->render('admin/categories_blog/index', ['categories_blog' =>  $categories_blog]);


    }


    public function create()
    {
        echo $this->view->render('admin/categories_blog/create');
    }


    public function store()
    {
        $validator = v::key('title', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название'
        ]);
        $_POST['slug'] = slug($_POST['title']);
        $this->database->create('categories_blog', $_POST);

        return redirect('/admin/categories_blog');
    }




    public function edit($id)
    {
        $category = $this->database->find('categories_blog', $id);
        echo $this->view->render('admin/categories_blog/edit', ['category'    =>  $category]);
    }

    public function update($id)
    {
        $validator = v::key('title', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название'
        ]);
        $_POST['slug'] = slug($_POST['title']);
        $this->database->update('categories_blog', $id, $_POST);

        return redirect('/admin/categories_blog');
    }

    public function delete($id)
    {
        $this->database->delete('categories_blog', $id);
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