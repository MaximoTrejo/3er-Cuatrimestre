<?php

require_once './clases/conjunto.php';


$aVenta = Venta::leerJson("venta.json");
$aTienda = Tienda::leerJson("tienda.json");



//a
echo "a"."\n";
$nombrePrenda = $_GET['nombrePrenda'];
Venta::consultaPrendaVenta($aVenta,$nombrePrenda);
echo "-------------------------------"."\n";

//c
echo "c"."\n";
Venta::consultaTodosConjunto($aVenta);
echo "-------------------------------"."\n";

//b
echo "b"."\n";
Venta::consultaConjuntoContieneStock($aTienda,$aVenta);
echo "-------------------------------"."\n";