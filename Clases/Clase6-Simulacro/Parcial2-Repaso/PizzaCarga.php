<?php

require_once './Clases/pizza.php';

$sabor = $_POST['sabor'];
$precio = $_POST['precio'];
$tipo= $_POST['tipo'];
$cantidad = $_POST['cantidad'];


//Generico
$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeHelados/';
//Generico



$nombreJson = 'Pizza.json';

$aPizza = Pizza::leerJson($nombreJson);

$aPizza = Pizza::agregarObjets($sabor,$precio,$tipo,$cantidad,$aPizza);

Pizza::guardarJSON($aPizza,$nombreJson);

Pizza::crearImagen($carpeta_archivos,$aPizza,$archivoTemp,$nombre_archivo);







