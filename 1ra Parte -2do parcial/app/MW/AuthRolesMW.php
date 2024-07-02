<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;


class  AuthRolesMW{

    public function  __invoke(Request $request,RequestHandler $handler){

        $roles = ['admin', 'cliente'];

        $response = new Response();
        $header = $request->getHeaderLine('Authorization');

        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            try {
                AutentificadorJWT::VerificarToken($token);
                $dataJWT = AutentificadorJWT::ObtenerData($token);

                if(in_array($dataJWT->tipo,$roles)){
                    $response = $handler->handle($request);
                }else{
                    $response->getBody()->write(json_encode(array("msg" => "El rol del usuario no es valido")));
                }

            }catch (Exception $ex) {
				$response->getBody()->write($ex->getMessage());
			}
        
        }
        return  $response;
        
    }

}


class  chekRolesMW{

    public function  __invoke(Request $request,RequestHandler $handler){

        $params = $request ->getParsedBody();
        $roles = ['admin', 'cliente','empleado'];

        if(isset($params["tipo"])){

            if(in_array($params['tipo'],$roles,true)){

                $response = $handler ->handle($request);
            }else{
                $response = new Response();
                $response->getBody()->write(json_encode(array("error"=> "Revise el rol ingresado , Opciones disponibles : admin, cliente "  )));
            }

        }else{
            $response = new Response();
            $response->getBody()->write(json_encode(array("error"=> "Rol incorrecto")));
        }
        return  $response;

    }

}

class AuthAdminMW{

    public function  __invoke(Request $request, RequestHandler $handler)
    {
        $response = new Response();
        $header = $request->getHeaderLine('Authorization');
        if (!empty($header)) {

            $token = trim(explode("Bearer", $header)[1]);
            try {
                AutentificadorJWT::VerificarToken($token);
                $dataJWT = AutentificadorJWT::ObtenerData($token);

                if(!strcasecmp($dataJWT->tipo, "admin")){
                    $response = $handler->handle($request);
                }else{
                    $response->getBody()->write(json_encode(array("msg" => "Solo los admin pueden realizar esta accion!")));
                }

            }catch (Exception $ex) {
				$response->getBody()->write($ex->getMessage());
			}
        
        } else {
            //si no estan completos los parametros le digo al usuario que faltan cargar las credenciales
            $response = new Response();
            $response->getBody()->write(json_encode(array("msg" => "No hay un token registrado. Inicie sesion.")));
        }
        return  $response;
    }

}

class AuthClienteMW{

    public function  __invoke(Request $request, RequestHandler $handler)
    {
        $response = new Response();
        $header = $request->getHeaderLine('Authorization');
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            try {
                AutentificadorJWT::VerificarToken($token);
                $dataJWT = AutentificadorJWT::ObtenerData($token);
                if(!strcasecmp($dataJWT->tipo, "cliente") || !strcasecmp($dataJWT->tipo, "admin") ){
                    $response = $handler->handle($request);
                }else{
                    $response->getBody()->write(json_encode(array("msg" => "Solo los clientes pueden realizar esta accion!")));
                }

            }catch (Exception $ex) {
				$response->getBody()->write($ex->getMessage());
			}
        
        } else {
            //si no estan completos los parametros le digo al usuario que faltan cargar las credenciales
            $response = new Response();
            $response->getBody()->write(json_encode(array("msg" => "No hay un token registrado. Inicie sesion.")));
        }
        return  $response;
    }

}

class AuthEmpleadoMW{

    public function  __invoke(Request $request, RequestHandler $handler)
    {
        $response = new Response();
        $header = $request->getHeaderLine('Authorization');
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            try {
                AutentificadorJWT::VerificarToken($token);
                $dataJWT = AutentificadorJWT::ObtenerData($token);
                if(!strcasecmp($dataJWT->tipo, "empleado") || !strcasecmp($dataJWT->tipo, "admin") ){
                    $response = $handler->handle($request);
                }else{
                    $response->getBody()->write(json_encode(array("msg" => "Solo los clientes pueden realizar esta accion!")));
                }

            }catch (Exception $ex) {
				$response->getBody()->write($ex->getMessage());
			}
        
        } else {
            //si no estan completos los parametros le digo al usuario que faltan cargar las credenciales
            $response = new Response();
            $response->getBody()->write(json_encode(array("msg" => "No hay un token registrado. Inicie sesion.")));
        }
        return  $response;
    }

}