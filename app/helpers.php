<?php

use App\Services\Database;
use App\Services\Roles;
use Delight\Auth\Auth;
use JasonGrimes\Paginator;
use Carbon\Carbon;


//function view($path, $parameters = [])
//{
//    global $container;
//    $plates = $container->get('plates');
//    echo $plates->render($path, $parameters);
//}


function back()
{
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function redirect($path)
{
    header("Location: $path");
    exit;
}

function abort($type)
{
    switch ($type) {
        case 404:
            $view = components(\League\Plates\Engine::class);
            echo $view->render('errors/404');exit;
        break;
    }
}

function config($field)
{
    $config = require '../app/config.php';
    return array_get($config, $field);
}

function auth()
{
    global $container;
    return $container->get(Auth::class);
}


function isAdmin()
{
//    return auth()->hasRole()
}

function getRole($key)
{
    return Roles::getRole($key);
}

function getImage($image) {
    return (new \App\Services\ImageManager())->getImage($image);
}

function paginate($count, $page, $perPage, $url)
{
    $totalItems = $count;
    $itemsPerPage = $perPage;
    $currentPage = $page;
    $urlPattern = $url;

    $paginator =  new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    return $paginator;

}

function paginator($paginator)
{
    include config('views_path') . 'partials/pagination.php';
}

function uploadedDate($timestamp)
{
    return date('d.m.Y', $timestamp);
}

function getCategory($id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    return $database->find('categories', $id);
}

function getPostSlug($id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    $post_slug = $database->find('posts', $id);
    return $post_slug['slug'];
}

function getUserName($id,$avtor)
{
    $name = ($avtor == 1) ? 'slug' : 'username';
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    $userName = $database->find('users', $id);
    return $userName[$name];
}

function getUserAvatar($id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    $userName = $database->find('users', $id);
    return $userName['image'];
}

function menu()
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    $cats = $database->all_category('categories');
    $menu = $database->menu_tree($cats, 0);
    return $menu;
}

function getCategoryTitle($id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    $title = $database->find('categories_blog', $id);
    return $title['title'];
}
function  getTagsTitles($id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    $tag = $database->find_tag($id);
    $tag_sort = (is_array($tag)) ? implode_all(';',$tag) : 'нет тегов';
    return $tag_sort;
}

function  getTagsName($slug)
{
   global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    $title = $database->find_name_tags('tags', $slug);
    return $title['title'];
}



function implode_all($glue, $arr){
    for ($i=0; $i<count($arr); $i++) {
        if (@is_array($arr[$i]))
            $arr[$i] = implode_all ($glue, $arr[$i]);
    }
    return implode($glue, $arr);
}

function getAllCategories()
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    return $database->all('categories');
}

function getComments_count()
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    return $database->getCount('comments','status', '0');
}

function Comments_count($post_id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    return $database->getCount_on('comments','post_id', $post_id);
}

function components($name)
{
    global $container;
    return $container->get($name);

}
function slug($s) {
    $s = (string) $s; // преобразуем в строковое значение
    $s = strip_tags($s); // убираем HTML-теги
    $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
    $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
}

function getDateSintez($date)
{
        $carbon =  Carbon::parse($date);           //createFromFormat('y/m/d',$date)->format('F d, Y');
        return $carbon->format('F d, Y');
}
function getDay($date)
{
    $carbon =  Carbon::parse($date);
    return $carbon->day;
}

function getMonth($date)
{

    $carbon =  Carbon::parse($date);
    $str = $carbon->format('F');
    return substr($str,0,3);
}
