<?php

require_once './clases/tienda.php';
require_once './clases/venta.php';


$nombre= $_POST['nombre'];
$tipo= $_POST['tipo'];
$talla= $_POST['talla'];
$stock = $_POST['stock'];
$mail = $_POST['mail'];


$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeVenta/2024/';


$nombreJsonTienda = 'tienda.json';
$nombreJsonVenta = 'venta.json';


$aTienda = Tienda::leerJson($nombreJsonTienda);

$aVentas = Venta::leerJson($nombreJsonVenta);

$aVenta = Venta::altaObjs($nombre,$tipo,$stock,$mail,$aTienda,$aVentas,$nombreJsonTienda);

Tienda::guardarJSON($aVenta,$nombreJsonVenta);

Venta::crearImagen($carpeta_archivos,$aVenta,$archivoTemp,$nombre_archivo);






