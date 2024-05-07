<?php include "funciones.php"?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/IconoWeb.ico">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>Registrarse</title>

    </head>

    <body  style="margin: 0px; min-height: 100vh; display: flex; flex-direction: column;">

        <?php printHeader() ?> <!-- Imprime el Header -->

        <main style="text-align: center; margin-bottom: 60px;">
                <h2>Formulario de registro</h2>
                <form action="show_data.php" target="_blank" style="border: 2px solid black; padding: 20px; margin-left: 700px; margin-right: 700px;  ">
                    <label for="nombre"><b>Nombre: </b></label><input type="text" name="nombre" placeholder="Ingrese su nombre"><br><br>
                    <label for="apellido"><b>Apellido: </b></label><input type="text" name="apellido" placeholder="Ingrese su apellido"><br><br>
                    <label for="direcion"><b>Direcion: </b></label><input type="text" name="direcion" placeholder="Ingrese su direcion"><br><br>
                    <label for="codigo_postal"><b>Codigo postal: </b></label><input type="number" name="codigo_postal" placeholder="Ingrese su codigo postal"><br><br>
                    <label for="fecha_nacimiento"><b>Fecha de nacimiento(dd/mm/aaaa): </b></label><input type="date" name="fecha_nacimiento" placeholder="(dd/mm/aaaa)"><br><br>
                    <p><b>Genero:</b> 
                        <input type="radio" name="genero" value="hombre">Hombre
                        <input type="radio" name="genero" value="Mujer">Mujer
                        <input type="radio" name="genero" value="Otro">Otro
                    </p>
                    <input type="submit" value="enviar">
                </form>
                <p>Si usted le da enviar, la informacion va a la pagina "show_data.php"</p>
        </main>

        <?php printFooterRegistro() ?> <!-- Imprime el Footer -->

    </body>
</html>