<?php
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);

    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->add(function ($request, $response, $next) {
    $route = $request->getAttribute('route');
    $methods = [];

    if (!empty($route)) {
        $pattern = $route->getPattern();

        foreach ($this->router->getRoutes() as $route) {
            if ($pattern === $route->getPattern()) {
                $methods = array_merge_recursive($methods, $route->getMethods());
            }
        }
        //Methods holds all of the HTTP Verbs that a particular route handles.
    } else {
        $methods[] = $request->getMethod();
    }

    $response = $next($request, $response);

    return $response->withHeader('Access-Control-Allow-Methods', implode(',', $methods));
});

//
$container = $app->getContainer();
$container['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};

$container['pdo'] = function ($c) {
    $pdo_config = $c->get('settings')['db'];
    $dsn = "mysql:dbname=" . $pdo_config['database'] . ";host=" . $pdo_config['host'];
    $pdo = new PDO($dsn, $pdo_config['username'], $pdo_config['password'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
    ]);
    return $pdo;
};

//Erro 404
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write('not found');
    };
};
// Erro 405
$container['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
        return $c['response']
            ->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode(array('code' => 405, 'message' => 'metodo não permitido, metodos válidos.', 'metodos' => implode(', ', $methods))));
    };
};
// Erro 500
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $c['response']->withStatus(500)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(array('erro' => array('code' => 500, 'message' => 'Não foi possível processar a solicitação.', 'Exception' => htmlspecialchars($exception)))));
    };
};