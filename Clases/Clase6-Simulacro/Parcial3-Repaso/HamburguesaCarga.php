<?php

require_once './clases/Hamburguesa.php';

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$tipo= $_POST['tipo'];
$aderezo= $_POST['aderezo'];
$cantidad = $_POST['cantidad'];

//Generico
$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeHamburguesas/';
//Generico


$nombreJson = 'Hamburguesa.json';

$aHamburguesa = Hamburguesa::leerJson($nombreJson);

$aHamburguesa = Hamburguesa::agregarObjets($nombre,$precio,$tipo,$aderezo,$cantidad,$aHamburguesa);

Hamburguesa::guardarJSON($aHamburguesa,$nombreJson);

Hamburguesa::crearImagen($carpeta_archivos,$aHamburguesa,$archivoTemp,$nombre_archivo);







