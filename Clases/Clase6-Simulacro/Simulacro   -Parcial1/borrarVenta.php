<?php

require_once './Clases/venta.php';


$numero_pedido = $_POST['nombreP'];

$aVenta = Venta::leerJson("venta.json");

$aVenta  = Venta::borrarVenta($numero_pedido,$aVenta);

Venta::guardarVenta($aVenta);