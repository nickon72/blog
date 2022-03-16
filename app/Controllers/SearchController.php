<?php


namespace App\Controllers;

use App\Services\Database;
use App\Services\ImageManager;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use BlueM;

class SearchController extends Controller{

    public function index()
    {

        $popular_posts = $this->database->popular_post('posts','views', 3);
        $recent_posts = $this->database->popular_post('posts','date', 3);
        $comment_posts = $this->database->popular_post_comment('comments','created_at', 3);
        $tags = $this->database->all('tags');

        $category_count = $this->database->count_category_post();

        $word = $_GET['word'];
        $posts = $this->database->search_Word('posts',$word);


        if(empty($posts))
        {
            flash()->error(['По Вашему запросу <b><i> ['. $word .'] </i></b> ничего не найдено']);
        }
        else
        {
            flash()->success(['Результаты поиска по :<b><i> ['. $word .']</i></b>']);
        }


        echo $this->view->render('search/index',  compact('posts', 'category_count','tags',
            'popular_posts','recent_posts','comment_posts','word'));

    }

} 