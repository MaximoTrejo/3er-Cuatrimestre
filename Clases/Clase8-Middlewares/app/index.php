<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

//use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response  as Response;
use Slim\Factory\AppFactory;
//use Slim\Handlers\Strategies\RequestHandler;
//use Slim\Routing\RouteCollectorProxy;
//use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';
//require_once './middlewares/Logger.php';
require_once './middlewares/AuthMiddleware.php';
require_once './controllers/UsuarioController.php';

//Load ENV
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

$usuarioMiddleware = function (Request $request,RequestHandler $handler){
  $params = $request ->getQueryParams();
  echo "Entro al middleware usuario \n";
  if(isset( $params["nombre"],$params["apellido"])){
    echo "Entro al verbo por el middleware \n";
    $response = $handler ->handle($request);
    
  }else{
    echo "NO entro al verbo \n";
    $response = new Response();
    $response->getBody()->write(json_encode(array("error"=> "Parametros incorrectos")));
  }
  echo "Finaliza el  middleware\n";
  return $response;
};

$app->group('/usuario', function (Request $request,Response $response) {
  $params= $request->getQueryParams();
  $nombre=$params["nombre"];
  $apellido=$params["apellido"];
  echo "Entro al verbo \n";
  $response->getBody()->write(json_encode(array($nombre,$apellido)));
  return $response ->withHeader('Content-Type','application/json');
})->add($usuarioMiddleware)
  ->add(new AuthMiddleware ()); //El primero el ejecutarse de los middleware siempre es el ultimo


$app->run();

