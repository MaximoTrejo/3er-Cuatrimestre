<?php

//llamado a clase usaurio 
require_once './models/tienda.php';
require_once './util/Archivo.php';
require_once './interfaces/IApiUsable.php';


class TiendaControllers extends Tienda implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        $precio = $parametros['precio'];
        $tipo = $parametros['tipo'];
        $talla = $parametros['talla'];
        $color = $parametros ['color'];
        $stock = $parametros ['stock'];

        // Creamos el pd
        $obj = new Tienda();
        $obj ->tie_nombre =$nombre;
        $obj ->tie_precio = $precio;
        $obj ->tie_tipo = $tipo;
        $obj->tie_talla = $talla;
        $obj->tie_color=$color;
        $obj->tie_stock=$stock;

        $objEncontrado = $obj->obtenerUno($nombre,$tipo);

        if(!empty($objEncontrado)){

            $stockNuevo = $objEncontrado[0]->tie_stock + $stock;
            $idObjt = $objEncontrado[0]->tie_id;
            $obj->modStock($stockNuevo ,$idObjt);
            $obj->modPrecio($idObjt,$precio);
            $payload = json_encode(array("mensaje" => "Se modifico porque ya existe"));

        }else{
            $obj->crearTienda();
            $payload = json_encode(array("mensaje" => "Se creo"));
            $rutaArchivo= BASEPATH . "\img_tienda/";

            Archivo::GuardarArchivoPeticion( $rutaArchivo, "{$obj->tie_nombre}{$obj->tie_tipo}_{$obj->tie_talla}", 'foto', '.jpg'); 

        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }


    public function ConsultaExiste($request, $response, $args){
        $parametros = $request->getParsedBody();
        $nombre = $parametros['nombre'];
        $tipo = $parametros['tipo'];
        $color = $parametros ['color'];
        $obj = new Tienda();
        $objEncontrado = $obj->obtenerUno($nombre,$tipo);
        if(!empty($objEncontrado)){

            if($objEncontrado[0]->tie_color == $color){
                $payload = json_encode(array("mensaje" => "Existe"));
            }else{
                $payload = json_encode(array("mensaje" => "No hay productos del nombre " .$nombre. "/ no hay productos del tipo ".$tipo));
            }

        }else{
            $payload = json_encode(array("mensaje" => "No hay productos del nombre " .$nombre. "/ no hay productos del tipo ".$tipo));
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');

    }

    public function ConsultaProdValores($request, $response, $args){
        $parametros = $request->getQueryParams();
        $precioDesde  = $parametros['precioDesde'];
        $precioHasta  = $parametros['precioHasta'];
        $lista = Tienda::productosEntreValores($precioDesde ,$precioHasta);
        $payload = json_encode(array("ConsultaProductosEntreValores" => $lista));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }


    public function ConsultaProdMasVendido($request, $response, $args){
        $lista = Tienda::productosMasVendido();
        $payload = json_encode(array("ConsultaProductosMasVendido" => $lista));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

}