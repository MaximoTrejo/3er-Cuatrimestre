<?php


require_once './clases/tienda.php';

$nombre  = $_POST['nombre'];
$tipo= $_POST['tipo'];
$color= $_POST['color'];

$nombreJson = 'tienda.json';

$aTienda = Tienda::leerJson($nombreJson);

$existe = Tienda::consultaIguales($nombre,$tipo,$color,$aTienda);

echo "La Tienda " . $existe;