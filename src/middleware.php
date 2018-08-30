<?php
$tokenIsValid = function ($request, $response, $next) {
    $route = $request->getAttribute('route');
    $args = $route->getArguments();

    if(!$args['token']){
        return $response->withJson(['code' => 400, 'message' => 'Token not found'], 400);
    }
    if($args['token'] != getenv('APP_TOKEN')){
        return $response->withJson(['code' => 400, 'message' => 'Token invalid'], 400);
    }

    return $next($request, $response);
};
