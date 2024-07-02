<?php

require_once './Clases/Heladeria.php';


$sabor = $_POST['saborH'];
$tipo= $_POST['tipo'];

$aHeladeria = Heladeria::leerJson("heladeria.json");

$existe = Heladeria::validarHeladerasIguales($sabor,$tipo,$aHeladeria);

echo "La heladeria " . $existe;