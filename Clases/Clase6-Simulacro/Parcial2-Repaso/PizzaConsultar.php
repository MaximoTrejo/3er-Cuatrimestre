<?php

require_once './clases/pizza.php';

$sabor = $_POST['sabor'];
$tipo= $_POST['tipo'];

$nombreJson = 'Pizza.json';

$aPizza = Pizza::leerJson($nombreJson);

$existe = Pizza::consultaIguales($sabor,$tipo,$aPizza);

echo "La heladeria " . $existe;