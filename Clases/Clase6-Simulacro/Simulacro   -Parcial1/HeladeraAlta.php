<?php

require_once './Clases/Heladeria.php';

$sabor = $_POST['saborH'];
$precio = $_POST['precio'];
$tipo= $_POST['tipo'];
$Vaso = $_POST['vaso'];
$stock = $_POST['stock'];

//Generico
$nombre_archivo = $_FILES ['archivo']['name'];
$archivoHeladoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDeHelados/2024/';



$aHeladeria = Heladeria::leerJson("heladeria.json");

$aHeladeria =Heladeria::agregarHeladeria($sabor, $precio , $tipo,$Vaso,$stock ,$aHeladeria);

Heladeria::guardarHeladeria($aHeladeria);

Heladeria::crearImagen($carpeta_archivos,$aHeladeria,$archivoHeladoTemp,$nombre_archivo);


