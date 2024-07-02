<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;

class AuthMWLogeado
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $header = $request->getHeaderLine('Authorization');
        if (!empty($header)) {

            $token = trim(explode("Bearer", $header)[1]);

            try {
                AutentificadorJWT::VerificarToken($token);

                
                $response = $handler->handle($request);
            } catch (Exception $ex) {
                $response->getBody()->write($ex->getMessage());
            }
        } else {
            $response->getBody()->write(json_encode(array("msg" => "No hay un token registrado. Inicie sesion.")));
        }

        return $response;
    }
}
