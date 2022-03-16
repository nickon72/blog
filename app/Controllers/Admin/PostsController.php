<?php

namespace App\Controllers\Admin;


use App\Services\ImageManager;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class PostsController extends Controller
{
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        parent::__construct();
        $this->imageManager = $imageManager;
    }

    public function index()
    {
        $posts = $this->database->all('posts');
        echo $this->view->render('admin/posts/index', ['posts'=>$posts]);
    }

    public function create()
    {
        $categories_blog = $this->database->all('categories_blog','id');
        $tags = $this->database->all('tags','id');

        echo $this->view->render('admin/posts/create', compact(
            'categories_blog',
            'tags'
        ));
    }

    public function store()
    {
        $validator = v::key('title', v::stringType()->notEmpty())
        ->key('content',v::stringType()->notEmpty())
        ->key('date', v::date('Y-m-d')->notEmpty());
        $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название',
            'content'   =>  'Заполните поле контент',
            'date'   =>  'Заполните дату',

        ]);
        $_POST['slug'] = slug($_POST['title']);
        $image = $this->imageManager->uploadImage($_FILES['image']);


        $data = [
            "image" =>  $image,
            "title" =>  $_POST['title'],
            "slug" =>  $_POST['slug'],
            "user_id"   =>  $this->auth->getUserId(),
            "description" =>  $_POST['description'],
            "category_id" =>  $_POST['category_id'],
            "date"  =>  $_POST['date'],
            "is_featured"  => '0',// $_POST['is_featured'],
            "status"  =>  '1',//$_POST['status'],
            "content"  =>  $_POST['content'],
        ];


        $last_id_post = $this->database->create('posts', $data);


        foreach ($_POST['tag_id'] as $tag_id)
        {
            $data_1 = [
                "tag_id" => $tag_id,
                "post_id" => $last_id_post,
            ];

            $this->database->create('post_tags', $data_1);
        }
        

        return redirect('/admin/posts');
    }

    public function edit($id)
    {
        $post = $this->database->find('posts',$id);
        $categories_blog = $this->database->all('categories_blog');
        $categories_blog_selected = $this->database->find('posts', $id);
        $tags = $this->database->all('tags');

        $selectedTags_ar = implode_all(',',$this->database->find_tag($id));
        $selectedTags = explode(',',$selectedTags_ar);

        echo $this->view->render('admin/posts/edit', compact(
            'post',
            'categories_blog',
            'categories_blog_selected',
            'tags',
            'selectedTags'
        ));

    }


    public function update($id)
    {
        $validator = v::key('title', v::stringType()->notEmpty())
            ->key('content',v::stringType()->notEmpty())
            ->key('date', v::date('Y-m-d')->notEmpty());

            $this->validate($validator, $_POST, [
            'title'   =>  'Заполните поле Название',
            'content'   =>  'Заполните поле контент',
            'date'   =>  'Заполните дату',

        ]);

        $_POST['slug'] = slug($_POST['title']);


         $image = $this->imageManager->uploadImage($_FILES['image']);

        $data = [
            "image" =>  $image,
            "title" =>  $_POST['title'],
            "slug" =>  $_POST['slug'],
            "user_id"   =>  $this->auth->getUserId(),
            "description" =>  $_POST['description'],
            "category_id" =>  $_POST['category_id'],
            "date"  =>  $_POST['date'],
            "is_featured"  => $_POST['is_featured'],
            "status"  => $_POST['status'],
            "content"  =>  $_POST['content'],
        ];
        if($image == null) unset($data['image']);
        if($_POST['is_featured'] == on) $data['is_featured'] = 1;
        if($_POST['status'] == on) $data['status'] = 1;


        $this->database->update('posts',$id, $data);

        $this->database->delete_post_tag('post_tags',$id);


        foreach ($_POST['tag_id'] as $tag_id)
        {
            $data_1 = [
                "tag_id" => $tag_id,
                "post_id" => $id,
            ];

            $this->database->create('post_tags',$data_1);
        }


        return redirect('/admin/posts');
    }


    public function delete($id)
    {
        $photo = $this->database->find('posts', $id);
        $this->database->delete('posts', $id);
        if($photo !== 'NULL') $this->imageManager->deleteImage($photo['image']);

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
