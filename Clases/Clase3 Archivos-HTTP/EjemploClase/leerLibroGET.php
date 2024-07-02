<?php

include_once("./clases/libro.php");

echo "<h3>Lectura de libro especifico por GET</h3><br/>";

//lo mismo que el post pero en ves de pasarle los parametros por el body 
//se los debo pasar por el Params 
if(isset($_GET["titulo"])){
    Libro::encontrarPrecio($_GET["titulo"]);
} else {
    echo "Parametro titulo no encontrado";
}


//el get busco
