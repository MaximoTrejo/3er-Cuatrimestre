<?php
require_once './clases/venta.php';
require_once './clases/pizza.php';


$sabor = $_POST['sabor'];
$tipo= $_POST['tipo'];
$cantidad = $_POST['cantidad'];
$mail = $_POST['mail'];


$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeLaVenta/';

$nombreJsonPizza = 'Pizza.json';
$nombreJsonVenta = 'Venta.json';

$aPizza = Pizza::leerJson($nombreJsonPizza);

$aVentas = Venta::leerJson($nombreJsonVenta);

$aVenta = Venta::altaObjs($sabor,$tipo,$cantidad,$mail,$aPizza,$aVentas,$nombreJsonPizza);

Pizza::guardarJSON($aVenta,$nombreJsonVenta);

Venta::crearImagen($carpeta_archivos,$aVenta,$archivoTemp,$nombre_archivo);