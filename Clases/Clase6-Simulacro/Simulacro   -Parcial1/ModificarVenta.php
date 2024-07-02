<?php


require_once './Clases/venta.php';

parse_str(file_get_contents("php://input"), $datos);
$sabor = $datos['saborH'];
$stock = $datos['stock'];
$mail = $datos['mail'];
$numero_pedido = $datos['nombreP'];



$aVenta = Venta::leerJson("venta.json");

$aVenta=Venta::modificarVenta($numero_pedido,$mail,$sabor,$stock,$aVenta);

Venta::guardarVenta($aVenta);



