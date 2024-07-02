<?php

require_once './clases/venta.php';

parse_str(file_get_contents("php://input"), $datos);
$tipo = $datos['tipo'];
$stock = $datos['stock'];

$nombre = $datos['nombre'];
$talla= $datos['talla'];

$mail = $datos['mail'];
$_id_autoincremental = $datos['numP'];



$nombreJsonVenta = 'venta.json';

$aVenta = Venta::leerJson($nombreJsonVenta);

$aVenta=Venta::modificarVenta($_id_autoincremental,$mail,$nombre,$talla,$tipo,$stock,$aVenta);

Tienda::guardarJSON($aVenta,$nombreJsonVenta);