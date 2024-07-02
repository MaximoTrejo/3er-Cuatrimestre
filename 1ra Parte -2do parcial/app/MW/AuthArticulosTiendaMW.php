<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;


class AuthArticulosTiendaMW{

    public function  __invoke(Request $request,RequestHandler $handler){

        $params = $request ->getParsedBody();

        if(isset($params["nombre"]) && isset($params["tipo"])){

            $nombre = $params["nombre"];
            $tipo = $params["tipo"];

            $artEncontrado = Tienda::obtenerUno($nombre,$tipo);

            if($artEncontrado != null){
                $response = $handler->handle($request);
            }else{
                $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "No existe ese articulo")));
            }
        }else{
            $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "No cargo los parametros nombre, tipo")));
        }
        return  $response;
    }


}

class AuthArticulosTipoMW{

    public function  __invoke(Request $request,RequestHandler $handler){

        $params = $request ->getParsedBody();

        $tipos = ['Camiseta' , 'Pantalon'];

        if(isset($params["tipo"])){


            if(in_array($params['tipo'],$tipos,true)){

                $response = $handler->handle($request);
            }else{
                $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "El tipo ingresado no es correcto . Tipos disponibles  : Camiseta , Pantalon")));
            }
        }else{
            $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "No cargo el parametro tipo")));
        }
        return  $response;
    }


}


class AuthArticulosTalleMW{

    public function  __invoke(Request $request,RequestHandler $handler){

        $params = $request ->getParsedBody();

        $talles = ['S','M', 'L'];

        if(isset($params["talla"])){

            if(in_array($params['talla'],$talles,true)){

                $response = $handler->handle($request);
            }else{
                $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "El talle ingresado no es correcto . Talles disponibles  : S,M, L")));
            }
        }else{
            $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "No cargo el parametro talle")));
        }
        return  $response;
    }


}