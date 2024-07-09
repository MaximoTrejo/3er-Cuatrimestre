<?php
require_once './clases/tienda.php';

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$tipo= $_POST['tipo'];
$talla= $_POST['talla'];
$color= $_POST['color'];
$stock = $_POST['stock'];

//Generico
$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeRopa/2024/';
//Generico

$nombreJson = 'tienda.json';


$aTienda = Tienda::leerJson($nombreJson);

$aTienda = Tienda::agregarObjets($nombre,$precio,$tipo,$talla,$color,$stock,$aTienda);

Tienda::guardarJSON($aTienda,$nombreJson);

Tienda::crearImagen($carpeta_archivos,$aTienda,$archivoTemp,$nombre_archivo);














