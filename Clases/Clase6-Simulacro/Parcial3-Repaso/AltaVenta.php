<?php

require_once './clases/Hamburguesa.php';
require_once './clases/venta.php';


$nombre= $_POST['nombre'];
$tipo= $_POST['tipo'];
$aderezo= $_POST['aderezo'];
$cantidad = $_POST['cantidad'];
$mail = $_POST['mail'];


$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeLaVenta/';

$nombreJsonHamburguesa = 'Hamburguesa.json';
$nombreJsonVenta = 'Venta.json';


$aHamburguesa = Hamburguesa::leerJson($nombreJsonHamburguesa);

$aVentas = Venta::leerJson($nombreJsonVenta);

$aVenta = Venta::altaObjs($nombre,$tipo,$cantidad,$mail,$aHamburguesa,$aVentas,$nombreJsonHamburguesa);

Hamburguesa::guardarJSON($aVenta,$nombreJsonVenta);

Venta::crearImagen($carpeta_archivos,$aVenta,$archivoTemp,$nombre_archivo);





