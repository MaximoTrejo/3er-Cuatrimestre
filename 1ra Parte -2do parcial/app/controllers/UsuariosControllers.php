<?php

//llamado a clase usaurio 
require_once './models/Usuarios.php';

//llamado a index 
require_once './interfaces/IApiUsable.php';
require_once './util/AutentificadorJWT.php';

class UsuarioController extends Usuarios implements IApiUsable
{

    public  function CargarUno($request, $response, $args)
    {
        //traer datos desde el compose
        $parametros = $request->getParsedBody();

        $mail= $parametros['mail'];
        $nombre= $parametros['nombre'];
        $clave = $parametros['clave'];
        $rol = $parametros['tipo'];
        // Creamos el usuario
        $usr = new Usuarios();
        $usr->usu_mail = $mail;
        $usr->usu_nombre = $nombre;
        $usr->usu_clave = $clave;
        $usr->usu_perfil = $rol;
        $rutaArchivo= BASEPATH . "/ImagenesUsuarios/2024/";
        //llamado a funcion 
        $usr->crearUsuario($rutaArchivo);
        Archivo::GuardarArchivoPeticion( $rutaArchivo, "{$usr->usu_nombre}{$usr->usu_perfil}_{$usr->usu_fecha_alta}", 'foto', '.jpg'); 
        $payload = json_encode(array("mensaje" => "Usuario creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function Login($request, $response, $args)
    {
        $params = $request->getParsedBody();
        if (isset($params['id']) && isset($params['usuario']) && isset($params['clave'])) {


            $usuario = Usuarios::TraerPorId($params['id']);


            if (!empty($usuario)) {


                if (!strcasecmp($params['usuario'], $usuario[0]->usu_nombre) && $params['clave'] == $usuario[0]->usu_clave) {


                    $jwt = AutentificadorJWT::CrearToken(
                        array(
                            'id' => $usuario[0]->usu_id,
                            'tipo' => $usuario[0]->usu_perfil,
                            'fecha' => date('Y-m-d'),
                            'hora' => date('H:i:s'),
                        )
                    );

                    if (!empty($jwt)) {
                        $payload = json_encode(array("OK . Tipo: ".$usuario[0]->usu_perfil . " JWT" => $jwt));
                    } else {
                        $payload = json_encode(array("mensaje" => "No se pudo crear el token "));
                    }
                } else {
                    $payload = json_encode(array("mensaje" => "Los datos del usuario #{$params['id']} no coinciden."));
                }
            } else {
                $payload = json_encode(array("mensaje" => "No existe un usuario con ese id."));
            }
        } else {
            $response->getBody()->write(json_encode(array("mensaje" => "Ingrese los datos para el login!")));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }


    


}