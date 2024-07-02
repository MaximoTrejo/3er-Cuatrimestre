<?php

require_once './models/venta.php';
require_once './models/tienda.php';
require_once './util/Archivo.php';
require_once './interfaces/IApiUsable.php';

class VentaControllers extends Venta {

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $mail = $parametros['mail'];
        $nombre = $parametros['nombre'];
        $tipo = $parametros['tipo'];
        $talla = $parametros['talla'];
        $stock = $parametros ['stock'];

        $obj = new Venta();
        $obj->ven_numPedido = $obj->NuevoNumPedido();
        $obj ->ven_mail = $mail;
        $obj ->ven_nombre =$nombre;
        $obj ->ven_tipo = $tipo;
        $obj->ven_talla = $talla;
        $obj->ven_stock= $stock;
        
        $objTienda = new Tienda();
        $objEncontrado = $objTienda ->obtenerUno($nombre ,$tipo);

        if(!empty($objEncontrado)){
            $stockNuevo = $objEncontrado[0]->tie_stock - $stock;
            $idObjt = $objEncontrado[0]->tie_id;
            $objTienda->modStock($stockNuevo ,$idObjt);
            $obj->crearVenta();
            $rutaArchivo= BASEPATH . "\img_venta/";
            Archivo::GuardarArchivoPeticion( $rutaArchivo, "{$obj->ven_nombre}{$obj->ven_tipo}_{$obj->ven_talla}_{$obj->ven_mail}", 'foto', '.jpg'); 

            $payload = json_encode(array("mensaje" => "Se modifico el stock y se creo la venta"));
        }else{
            $payload = json_encode(array("mensaje" => "No se creo la venta ya que el articulo no existe"));
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }


    public function ConsultaProductosVendidos($request, $response, $args){

        $parametros = $request->getQueryParams();
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        if (DateTime::createFromFormat('Y-m-d', $parametros['fecha'])) {
            $fecha = new DateTime($parametros['fecha']);
        } else {
            $fecha = new DateTime('yesterday');
        }
        $fecha  = $fecha ->format('Y-m-d');
        $lista = Venta::ventaPorFecha($fecha);
        $payload = json_encode(array("ConsultaProductosVenta" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function ConsultaVentaUsuario($request, $response, $args){
        $parametros = $request->getQueryParams();
        $usuario  = $parametros['usuario'];
        $lista = Venta::ventaPorUsuario($usuario);
        $payload = json_encode(array("ConsultaVentaPorUsuario" => $lista));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function ConsultaPorProducto($request, $response, $args){
        $parametros = $request->getQueryParams();
        $producto  = $parametros['producto'];
        $lista = Venta::ventaPorProducto($producto );
        $payload = json_encode(array("ConsultaPorProducto" => $lista));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }


    public function ConsultaPorIngreso($request, $response, $args){
        $parametros = $request->getQueryParams();
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        if (DateTime::createFromFormat('Y-m-d', $parametros['fecha'])) {
            $fecha = new DateTime($parametros['fecha']);
            $fecha  = $fecha ->format('Y-m-d');
            $lista = Venta::gananciaPorFecha($fecha);
        } else {
            $lista = Venta::gananciaTotal();
        }
        $payload = json_encode(array("ConsultaPorIngreso" => $lista));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }


    public function modVenta($request, $response, $args){

        $parametros = $request->getParsedBody();
        $numeroPedido =  $parametros["numeroPedido"];
        $mail = $parametros["mail"];
        $nombre = $parametros["nombre"];
        $tipo = $parametros["tipo"];
        $talla = $parametros["talla"];
        $cantidad = $parametros["cantidad"];
        $obj = new Venta();
        $obj->modificarVenta($numeroPedido,$mail,$nombre,$tipo,$talla,$cantidad);
        $payload = json_encode(array("mensaje" => "Se modifico la venta"));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }


    public function ExportarCsv($request, $response, $args)
    {
        $lista = Venta::obtenerTodos();
        // Definir la ruta y el nombre del archivo CSV
        $filePath = './Ventas/Descargar/Venta.csv';// Asegúrate de que esta ruta sea válida y tenga permisos de escritura

        $file = fopen($filePath, 'w');
        // Escribir la cabecera del archivo CSV
        fputcsv($file, array('id', 'numPedido', 'mail', 'nombre','tipo','talla','stock'.'fecha'));

        // Escribir los datos de cada mesa en el archivo CSV
        foreach ($lista as $obj) {
            fputcsv($file, array($obj->ven_id, $obj->ven_numPedido , $obj->ven_mail , $obj->ven_nombre , $obj->ven_tipo , $obj->ven_talla , $obj->ven_stock ,$obj->ven_fecha));
        }

        // Cerrar el archivo
        fclose($file);
        $payload = json_encode(array("mensaje" => "Se exporto el csv"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }




}
