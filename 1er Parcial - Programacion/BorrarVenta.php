<?php


require_once './clases/venta.php';

parse_str(file_get_contents("php://input"), $datos);

$numero_pedido = $datos['numP'];

$aVenta = Venta::leerJson("venta.json");

$aVenta  = Venta::borrarVenta($numero_pedido,$aVenta);

Venta::guardarVenta($aVenta);

