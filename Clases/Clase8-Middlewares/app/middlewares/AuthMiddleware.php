<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response  as Response;


class  AuthMiddleware{

    public function  __invoke(Request $request,RequestHandler $handler){
        $params = $request ->getQueryParams();
        echo "Entro al middleware AuthMidd \n";
        $credenciales =$params["credenciales"];

        if(isset($credenciales)){
            if($credenciales == "ADMIN"){
                $response = $handler ->handle($request);
            }else{
                $response = new Response();
                $response->getBody()->write(json_encode(array("error"=> "No sos admin")));
            }

        }else{
            $response = new Response();
            $response->getBody()->write(json_encode(array("error"=> "No hay credeciales")));
        }
        echo "Salgo al middleware AuthMidd \n";
        return  $response->withHeader('Content-Type', 'application/json');;
        
    }



    /*Esta funcion valida que el nombre y el apellido esten cargados 
    //-------------------------------------------------------------------
    public function  __invoke(Request $request,RequestHandler $handler){

        $params = $request ->getQueryParams();

        echo "Entro al middleware usuario \n";
      
        if(isset($params["nombre"],$params["apellido"])){
          echo "Entro al verbo por el middleware \n";
          $response = $handler ->handle($request);
          
        }else{
          echo "NO entro al verbo \n";
          $response = new Response();
          $response->getBody()->write(json_encode(array("error"=> "Parametros incorrectos")));
        }
        echo "Finaliza el  middleware\n";
        return $response;
    }
    */

}