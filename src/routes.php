<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$rotas = function () use ($tokenIsValid) {
    $this->any('[/{token}/{id}[/{content}]]', function(Request $request, Response $response, array $args){
        
        $headers = $request->getHeaders();
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        $req = array(
            'headers' => $headers,
            'method' => $method,
            'body' => $body,
            'id'    => $args['id'],
            'content' => $args['content'],
            'path' => $args['id'].'/'.$args['content']
        );
        
        $fileName = ROOT.'/docs/'.$args['id'].'.json';
        $file = fopen($fileName, "w");
        fwrite($file, json_encode($req, JSON_PRETTY_PRINT));
        fclose($file);

        return $response->withJson($req);
    })->add($tokenIsValid);
};

// Api Routes
$app->group('/wh', $rotas);


