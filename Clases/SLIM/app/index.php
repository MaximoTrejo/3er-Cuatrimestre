<?php


require_once '../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();


$app->get('/', function ($request, $response, array $args) {
		$response->getBody()->write("Funciona!");
return $response;
});

$app->get("/usuarios",function (Request $request , Response $response, $args){
    $params = $request->getQueryParams();

    //te toma los parametros 
    $response->getBody()->write(json_encode($params)); 
    //$response->getBody()->write("{'nombre','agus'}");
    return  $response;
});

$app->run();

?>
