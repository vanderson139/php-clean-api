<?php declare(strict_types = 1);

$app = include('app.php');

\Core\Service\Database::connect(new \Api\Database\Connection\RedBean());

$request = $app->make('Http\HttpRequest');
$response = $app->make('Http\HttpResponse');

$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include_once(__DIR__ . '/routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(\Api\Enum\HttpResponse::NOT_FOUND);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        $class = $app->make($className);
        $class->$method($vars);
        break;
}

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

echo $response->getContent();