<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;

class AuthProducVendido
{
    public function  __invoke(Request $request, RequestHandler $handler)
    {

        $response = new Response();
        $params = $request->getQueryParams();

        if (!empty(isset($params["fecha"]))){

            if (!empty($params["fecha"])) {
                $response = $handler->handle($request);
            }else{
                $response->getBody()->write(json_encode(array("error" => "Cargo el parametro vacio")));
            }
        }else{
            $response->getBody()->write(json_encode(array("error" => "No cargo el parametros fecha")));
        }
        return  $response;
    }
}



class AuthEntreValore
{
    public function  __invoke(Request $request, RequestHandler $handler)
    {

        $response = new Response();
        $params = $request->getQueryParams();

        if (!empty(isset($params["precioDesde"])) && !empty(isset($params["precioHasta"]))){
            if (!empty($params["precioDesde"]) && !empty($params["precioHasta"])) {
                $response = $handler->handle($request);
            }else{
                $response->getBody()->write(json_encode(array("error" => "cargo el parametro vacio")));
            }
        }else{
            $response->getBody()->write(json_encode(array("error" => "No cargo los parametros")));
        }
        return  $response;
    }
}


class AuthPorProducto
{
    public function  __invoke(Request $request, RequestHandler $handler)
    {

        $response = new Response();
        $params = $request->getQueryParams();

        if (!empty(isset($params["producto"]))){
            if (!empty($params["producto"])) {
                $response = $handler->handle($request);
            }else{
                $response->getBody()->write(json_encode(array("error" => "cargo el parametro vacio")));
            }
        }else{
            $response->getBody()->write(json_encode(array("error" => "No cargo los parametros")));
        }
        return  $response;
    }
}



class AuthConsultaVentaUsuario
{
    public function  __invoke(Request $request, RequestHandler $handler)
    {

        $response = new Response();
        $params = $request->getQueryParams();

        if (!empty(isset($params["usuario"]))){
            if (!empty($params["usuario"])) {
                $response = $handler->handle($request);
            }else{
                $response->getBody()->write(json_encode(array("error" => "Cargo el parametro vacio")));
            }
        }else{
            $response->getBody()->write(json_encode(array("error" => "No cargo los parametros usuarios")));
        }
        return  $response;
    }
}