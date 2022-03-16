<?php
namespace App\Controllers\Admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = $this->database->all('categories');

        echo $this->view->render('admin/categories/index', ['categories' =>  $categories]);


            }



    public function tree()
    {
        $cats = $this->database->all_category('categories');
        $tree = $this->database->build_tree($cats,0);

      //  echo $this->view->render('contact/proba', ['tree' =>  $tree]);
        echo $this->view->render('admin/categories/index-1', ['tree' =>  $tree]);
              // dd($cats);
      // echo $tree;

    }


    public function create()
    {
        echo $this->view->render('admin/categories/create');
    }

    public function create_children($id)
    {
        $category = $this->database->find('categories', $id);
        echo $this->view->render('admin/categories/create_children', ['category'    =>  $category]);
    }

    public function store()
    {
        $validator = v::key('title', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название'
        ]);
        $_POST['slug'] = slug($_POST['title']);
        $this->database->create('categories', $_POST);

        return redirect('/admin/categories');
    }




    public function edit($id)
    {
        $category = $this->database->find('categories', $id);
        echo $this->view->render('admin/categories/edit', ['category'    =>  $category]);
    }

    public function update($id)
    {
        $validator = v::key('title', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название'
        ]);
        $_POST['slug'] = slug($_POST['title']);
        $this->database->update('categories', $id, $_POST);

        return redirect('/admin/categories');
    }

    public function delete($id)
    {
        $this->database->delete('categories', $id);
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