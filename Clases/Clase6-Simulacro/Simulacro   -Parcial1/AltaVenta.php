<?php

require_once './Clases/venta.php';

$sabor = $_POST['saborH'];
$tipo= $_POST['tipo'];
$stock = $_POST['stock'];
$mail = $_POST['mail'];


$nombre_archivo = $_FILES ['archivo']['name'];
$archivoHeladoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeLaVenta/2024/';

$aHeladeria = Heladeria::leerJson("heladeria.json");

$aVentas = Venta::leerJson("venta.json");

$aVenta = Venta::altaVenta($sabor,$tipo,$stock,$mail,$aHeladeria,$aVentas);

Venta::guardarVenta($aVenta);

Venta::crearImagen($carpeta_archivos,$aVenta,$archivoHeladoTemp,$nombre_archivo);




