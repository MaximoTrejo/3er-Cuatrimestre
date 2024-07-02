<?php

require_once './clases/Hamburguesa.php';

$nombre  = $_POST['nombre'];
$tipo= $_POST['tipo'];

$nombreJson = 'Hamburguesa.json';

$aHamburguesa = Hamburguesa::leerJson($nombreJson);

$existe = Hamburguesa::consultaIguales($nombre,$tipo,$aHamburguesa);

echo "La Hamburguesa " . $existe;