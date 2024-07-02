<?php
//defino donde guardo los archivos 
$carpeta_archivos = 'subida/';

//datos del archivo 
$nombre_archivo = $_FILES ['archivo']['name'];
$tipo_archivo = $_FILES ['archivo']['type'];
$tamano_archivo = $_FILES ['archivo']['size'];

//ruta destino (dnde se guarda);
$ruta_destino = $carpeta_archivos . $nombre_archivo . time(). $nombre_archivo;


if(move_uploaded_file($_FILES['archivo']['tmp_name'],$ruta_destino)){
    echo 'el archivo ha sido cargado correctamente';
}else{
    echo "ocurrio un error";
}