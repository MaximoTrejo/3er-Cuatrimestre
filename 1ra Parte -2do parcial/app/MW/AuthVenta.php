<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;

class AuthVenta{
    public function  __invoke(Request $request,RequestHandler $handler){

        $params = $request ->getParsedBody();

        if(isset($params["numeroPedido"]) ){

            $numeroPedido = $params["numeroPedido"];

            $pedidoEncontrado = Venta::obtenerUno($numeroPedido);

            if($pedidoEncontrado != null){
                $response = $handler->handle($request);
            }else{
                $response = new Response();
                $response->getBody()->write(json_encode(array("error" => "No existe ese pedido")));
            }


        }else{
            $response = new Response();
            $response->getBody()->write(json_encode(array("error" => "No cargo los parametros")));
        }

        return  $response;
    }

}