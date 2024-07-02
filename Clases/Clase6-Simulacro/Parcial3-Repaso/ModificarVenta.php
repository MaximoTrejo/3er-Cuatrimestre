<?php

require_once './Clases/venta.php';


parse_str(file_get_contents("php://input"), $datos);
$tipo = $datos['tipo'];
$cantidad = $datos['stock'];
$mail = $datos['mail'];
$_id_autoincremental = $datos['numP'];

$nombreJsonVenta = 'Venta.json';


$aVenta = Venta::leerJson($nombreJsonVenta);

$aVenta=Venta::modificarVenta($_id_autoincremental,$mail,$tipo,$cantidad,$aVenta);

Hamburguesa::guardarJSON($aVenta,$nombreJsonVenta);
