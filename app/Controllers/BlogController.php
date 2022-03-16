<?php
namespace App\Controllers;

use App\Services\Database;
use App\Services\ImageManager;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;

class BlogController extends Controller
{
    public function index()
    {
        $popular_posts = $this->database->popular_post('posts','views', 3);
        $recent_posts = $this->database->popular_post('posts','date', 3);
        $comment_posts = $this->database->popular_post_comment('comments','created_at', 3);
        $tags = $this->database->all('tags');

        $category_count = $this->database->count_category_post();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 5;

        $posts = $this->database->getPaginatedFrom_all('posts', $page, $perPage);

        $paginator = paginate(
            $this->database->getCount_all('posts'),
            $page,
            $perPage,
            "/blog?page=(:num)"
        );

        echo $this->view->render('blog/index',  compact('posts','paginator', 'category_count','tags',
                                                       'popular_posts','recent_posts','comment_posts'));
    }

    public function slug_categories($slug)
    {
        $popular_posts = $this->database->popular_post('posts','views', 3);
        $recent_posts = $this->database->popular_post('posts','date', 3);
        $comment_posts = $this->database->popular_post_comment('comments','created_at', 3);
        $tags = $this->database->all('tags');

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 5;

        $category = $this->database->find_id('categories_blog','slug',$slug);
        $posts = $this->database->getPaginatedFrom('posts', 'category_id', $category['id'], $page, $perPage);
        $paginator = paginate(
            $this->database->getCount('posts', 'category_id',$category['id']),
            $page,
            $perPage,
            "/blog/$slug?page=(:num)"
        );

        $category_count = $this->database->count_category_post();
        echo $this->view->render('blog/categories',compact('posts','paginator','category_count','category','slug','tags',
                                                            'popular_posts','recent_posts','comment_posts'));
    }

    public function author($username)
    {

        $popular_posts = $this->database->popular_post('posts','views', 3);
        $recent_posts = $this->database->popular_post('posts','date', 3);
        $comment_posts = $this->database->popular_post_comment('comments','created_at', 3);
        $tags = $this->database->all('tags');


        $author = $this->database->find_id('users','slug',$username);
        $user_id = $author['id'];


        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 5;


        $posts = $this->database->getPaginatedFrom('posts', 'user_id', $user_id, $page, $perPage);
        $paginator = paginate(
            $this->database->getCount('posts','user_id',$user_id),
            $page,
            $perPage,
            "/blog/author/$username?page=(:num)"
        );

        $category_count = $this->database->count_category_post();
        echo $this->view->render('blog/author',compact('posts','paginator','category_count','username','tags',
                                                        'popular_posts','recent_posts','comment_posts'));
    }

  public function single_post($slug)
  {
      $popular_posts = $this->database->popular_post('posts','views', 3);
      $recent_posts = $this->database->popular_post('posts','date', 3);
      $comment_posts = $this->database->popular_post_comment('comments','created_at', 3);
      $tags = $this->database->all('tags');


      $post_id = $this->database->find_id('posts','slug',$slug);
      $post = $this->database->find('posts',$post_id['id']);
      $comments = $this->database->find_all_where_comments('comments','post_id',$post_id['id']);

      $category_count = $this->database->count_category_post();//для сайдбара количество постов к категории

      echo $this->view->render('blog/single_post',[
                     'slug' =>  $slug,
                     'post' => $post,
                     'category_count' => $category_count,
                     'comments' => $comments,
                     'popular_posts' => $popular_posts,
                     'recent_posts' => $recent_posts,
                     'comment_posts' =>$comment_posts,
                     'tags' => $tags
                      ]);
  }

    public function tags_post($slug)
    {

        $popular_posts = $this->database->popular_post('posts','views', 3);
        $recent_posts = $this->database->popular_post('posts','date', 3);
        $comment_posts = $this->database->popular_post_comment('comments','created_at', 3);
        $tags = $this->database->all('tags');

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 3;

        $tag_id = $this->database->find_id('tags','slug',$slug);


        $posts = $this->database->getPaginatedFrom_post_for_tag('posts',$tag_id['id'], $page, $perPage);

        $paginator = paginate(
            count($this->database->post_for_tag('posts',$tag_id['id'])),
            $page,
            $perPage,
            "/blog/tags_post/$slug?page=(:num)"

         );

        $category_count = $this->database->count_category_post();
        echo $this->view->render('blog/tags',compact('posts','paginator','category_count','slug','tags',
            'popular_posts','recent_posts','comment_posts','tag_id'));
    }

    public function user($id)
    {

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 8;

        $photos = $this->database->getPaginatedFrom('photos', 'user_id' ,$id, $page, $perPage);

        $paginator = paginate(
            $this->database->getCount('photos', 'user_id',$id),
            $page,
            $perPage,
            "/user/$id?page=(:num)"
        );

        $user = $this->database->find('users', $id);

        echo $this->view->render('user', [
            'photos' =>  $photos,
            'user'  =>  $user,
            'paginator'    =>  $paginator
        ]);
    }

    public function store()
    {
        //dd($_POST);
        $validator = v::key('text', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, [
            'text'   =>  'Заполните поле Сообщение'
            
        ]);

        $this->database->create('comments', $_POST);
        flash()->success(['Благодарим, Ваш комментарий добавлен, после проверки модератором он будет отображен']);

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