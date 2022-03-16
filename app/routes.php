<?php

use Aura\SqlQuery\QueryFactory;
use DI\ContainerBuilder;
use Delight\Auth\Auth;
use FastRoute\RouteCollector;
use League\Plates\Engine;

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class    =>  function() {
        return new Engine('../app/Views');
    },

    Swift_Mailer::class => function() {
        $transport = (new Swift_SmtpTransport(
            config('mail.smtp'),
            config('mail.port'),
            config('mail.encryption')
        ))
        ->setUsername(config('mail.email'))
        ->setPassword(config('mail.password'));
    return new Swift_Mailer($transport);
    },

    PDO::class => function() {
        $driver = config('database.driver');
        $host = config('database.host');
        $database_name = config('database.database_name');
        $username = config('database.username');
        $password = config('database.password');

        return new PDO("$driver:host=$host;dbname=$database_name", $username, $password);
    },

    Auth::class   =>  function($container) {
        return new Auth($container->get('PDO'));
    },

    QueryFactory::class  =>  function() {
        return new QueryFactory('mysql');
    }
]);

$container = $containerBuilder->build();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
$r->get('/', ['App\Controllers\HomeController', 'index']);
$r->get('/category/{id:\d+}', ['App\Controllers\HomeController', 'category']);
$r->get('/user/{id:\d+}', ['App\Controllers\HomeController', 'user']);
$r->get('/photo/{id:\d+}', ['App\Controllers\HomeController', 'photo']);


$r->get('/register', ['App\Controllers\RegisterController', 'showForm']);
$r->post('/register', ['App\Controllers\RegisterController', 'register']);

$r->get('/login', ['App\Controllers\LoginController', 'showForm']);
$r->post('/login', ['App\Controllers\LoginController', 'login']);
$r->get('/logout', ['App\Controllers\LoginController', 'logout']);

$r->get('/password-recovery', ['App\Controllers\ResetPasswordController', 'showForm']);
$r->post('/password-recovery', ['App\Controllers\ResetPasswordController', 'recovery']);
$r->get('/password-recovery/form', ['App\Controllers\ResetPasswordController', 'showSetForm']);

$r->post('/password-recovery/change', ['App\Controllers\ResetPasswordController', 'change']);
$r->get('/email-verification', ['App\Controllers\VerificationController', 'showForm']);
$r->get('/verify_email', ['App\Controllers\VerificationController', 'verify']);
$r->post('/resend_email', ['App\Controllers\ResendEmailController', 'resend_email']);

$r->get('/profile/info', ['App\Controllers\ProfileController', 'showInfo']);
$r->post('/profile/info', ['App\Controllers\ProfileController', 'postInfo']);

$r->get('/profile/security', ['App\Controllers\ProfileController', 'showSecurity']);
$r->post('/profile/security', ['App\Controllers\ProfileController', 'postSecurity']);

$r->get('/contact', ['App\Controllers\ContactController', 'showContact']);
$r->post('/contact', ['App\Controllers\ContactController', 'postContact']);

$r->get('/blog', ['App\Controllers\BlogController', 'index']);
$r->get('/blog/{slug}', ['App\Controllers\BlogController', 'slug_categories']);
$r->get('/blog/author/{username}', ['App\Controllers\BlogController', 'author']);
$r->get('/single_post/{slug}', ['App\Controllers\BlogController', 'single_post']);
$r->post('/single_post/store', ['App\Controllers\BlogController', 'store']);
$r->get('/blog/tags_post/{slug}', ['App\Controllers\BlogController', 'tags_post']);
$r->get('/kurses/{slug}', ['App\Controllers\KursesController', 'kurses']);
$r->get('/search', ['App\Controllers\SearchController', 'index']);

$r->get('/photos', ['App\Controllers\PhotosController', 'index']);
$r->get('/photos/{id:\d+}', ['App\Controllers\PhotosController', 'show']);
$r->get('/photos/{id:\d+}/download', ['App\Controllers\PhotosController', 'download']);
$r->get('/photos/create', ['App\Controllers\PhotosController', 'create']);
$r->post('/photos/store', ['App\Controllers\PhotosController', 'store']);
$r->get('/photos/{id:\d+}/edit', ['App\Controllers\PhotosController', 'edit']);
$r->post('/photos/{id:\d+}/update', ['App\Controllers\PhotosController', 'update']);
$r->get('/photos/{id:\d+}/delete', ['App\Controllers\PhotosController', 'delete']);

$r->addGroup('/admin', function (RouteCollector $r) {
    $r->get('', ['App\Controllers\Admin\HomeController', 'index']);

    $r->get('/categories', ['App\Controllers\Admin\CategoriesController', 'index']);
    $r->get('/tree', ['App\Controllers\Admin\CategoriesController', 'tree']);
    $r->get('/categories/create', ['App\Controllers\Admin\CategoriesController', 'create']);
    $r->post('/categories/store', ['App\Controllers\Admin\CategoriesController', 'store']);
    $r->get('/categories/{id:\d+}/edit', ['App\Controllers\Admin\CategoriesController', 'edit']);
    $r->post('/categories/{id:\d+}/update', ['App\Controllers\Admin\CategoriesController', 'update']);
    $r->get('/categories/{id:\d+}/delete', ['App\Controllers\Admin\CategoriesController', 'delete']);
    $r->get('/categories/{id:\d+}/create_children', ['App\Controllers\Admin\CategoriesController', 'create_children']);
    $r->post('/categories/{id:\d+}/store_children', ['App\Controllers\Admin\CategoriesController', 'store_children']);

    $r->get('/categories_blog', ['App\Controllers\Admin\Categories_blogController', 'index']);
    $r->get('/categories_blog/create', ['App\Controllers\Admin\Categories_blogController', 'create']);
    $r->post('/categories_blog/store', ['App\Controllers\Admin\Categories_blogController', 'store']);
    $r->get('/categories_blog/{id:\d+}/edit', ['App\Controllers\Admin\Categories_blogController', 'edit']);
    $r->post('/categories_blog/{id:\d+}/update', ['App\Controllers\Admin\Categories_blogController', 'update']);
    $r->get('/categories_blog/{id:\d+}/delete', ['App\Controllers\Admin\Categories_blogController', 'delete']);

    $r->get('/posts', ['App\Controllers\Admin\PostsController', 'index']);
    $r->get('/posts/create', ['App\Controllers\Admin\PostsController', 'create']);
    $r->post('/posts/store', ['App\Controllers\Admin\PostsController', 'store']);
    $r->get('/posts/{id:\d+}/edit', ['App\Controllers\Admin\PostsController', 'edit']);
    $r->post('/posts/{id:\d+}/update', ['App\Controllers\Admin\PostsController', 'update']);
    $r->get('/posts/{id:\d+}/delete', ['App\Controllers\Admin\PostsController', 'delete']);


    $r->get('/tags', ['App\Controllers\Admin\TagsController', 'index']);
    $r->get('/tags/create', ['App\Controllers\Admin\TagsController', 'create']);
    $r->post('/tags/store', ['App\Controllers\Admin\TagsController', 'store']);
    $r->get('/tags/{id:\d+}/edit', ['App\Controllers\Admin\TagsController', 'edit']);
    $r->post('/tags/{id:\d+}/update', ['App\Controllers\Admin\TagsController', 'update']);
    $r->get('/tags/{id:\d+}/delete', ['App\Controllers\Admin\TagsController', 'delete']);

    $r->get('/comments', ['App\Controllers\Admin\CommentsController', 'index']);
    $r->get('/comments/toggle_on/{id}', ['App\Controllers\Admin\CommentsController', 'toggle_on']);
    $r->get('/comments/toggle_off/{id}', ['App\Controllers\Admin\CommentsController', 'toggle_off']);
    $r->get('/comments/{id:\d+}/delete', ['App\Controllers\Admin\CommentsController', 'delete']);

    $r->get('/subs', ['App\Controllers\Admin\SubscribersController', 'index']);
    $r->get('/subs/{id:\d+}/delete', ['App\Controllers\Admin\SubscribersController', 'delete']);
    $r->get('/subs/create', ['App\Controllers\Admin\SubscribersController', 'create']);
    $r->post('/subs/store', ['App\Controllers\Admin\SubscribersController', 'store']);


    $r->get('/users', ['App\Controllers\Admin\UsersController', 'index']);
    $r->get('/users/create', ['App\Controllers\Admin\UsersController', 'create']);
    $r->post('/users/store', ['App\Controllers\Admin\UsersController', 'store']);
    $r->get('/users/{id:\d+}/edit', ['App\Controllers\Admin\UsersController', 'edit']);
    $r->post('/users/{id:\d+}/update', ['App\Controllers\Admin\UsersController', 'update']);
    $r->get('/users/{id:\d+}/delete', ['App\Controllers\Admin\UsersController', 'delete']);


    $r->get('/photos', ['App\Controllers\Admin\PhotosController', 'index']);
    $r->get('/photos/create', ['App\Controllers\Admin\PhotosController', 'create']);
    $r->post('/photos/store', ['App\Controllers\Admin\PhotosController', 'store']);
    $r->get('/photos/{id:\d+}/edit', ['App\Controllers\Admin\PhotosController', 'edit']);
    $r->post('/photos/{id:\d+}/update', ['App\Controllers\Admin\PhotosController', 'update']);
    $r->get('/photos/{id:\d+}/delete', ['App\Controllers\Admin\PhotosController', 'delete']);
    });
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
$uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        dd('404 Страница не найдена');
    break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        dd('Метод запроса не верный');
    break;
        case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        // ... call $handler with $vars
    break;
}