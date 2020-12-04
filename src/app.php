<?php declare(strict_types = 1);

$app = new \Auryn\Injector;

$app->alias('Http\Request', 'Http\HttpRequest');
$app->share('Http\HttpRequest');
$app->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
    ':inputStream' => file_get_contents('php://input'),
]);

$app->alias('Http\Response', 'Http\HttpResponse');
$app->share('Http\HttpResponse');

$app->alias('Core\Adapter\Database\ConnectionInterface', 'Api\Database\ORM\RedBean');
$app->share('Api\Database\ORM\RedBean');

return $app;