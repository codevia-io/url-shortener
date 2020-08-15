<?php

require_once __DIR__ . '/bootstrap.php';

// Allow to post JSON data to PHP server
if (sizeof($_POST) === 0) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/', '\\Page\\Home');
    $r->get('/{id}', '\\API\\URL');
    $r->post('/api/url', '\\API\\URL');
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
        header(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        header(405);
        break;
    case FastRoute\Dispatcher::FOUND:
        $class = $routeInfo[1];
        $vars = $routeInfo[2];
        $instance = new $class();
        $instance->{$_SERVER['REQUEST_METHOD']}($entityManager, $vars);
        break;
}
