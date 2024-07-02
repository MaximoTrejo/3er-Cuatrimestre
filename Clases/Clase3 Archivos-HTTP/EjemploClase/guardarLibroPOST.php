<?php
    include_once("./clases/libro.php");
    
    echo "<h1>Archivos</h1><br/><br/>";

    //sirve para indicar que los datos esten completos 
    //si les paso los datos por el body agrego el libro 
    if(isset($_POST["titulo"]) && isset($_POST["precio"])){
        $libro = new Libro($_POST["titulo"], $_POST["precio"]);

        Libro::guardarLibro($libro);
    } else {
        //si no le paso los parametros me aparece esto 
        echo "Parametros incorrectos";
    }


    //el post utiliza el body
    //el post creo