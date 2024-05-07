<?php include "funciones.php"?>

<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./img/IconoWeb.ico">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>BlazeBoard </title>
    </head>

    <body style="margin: 0px;">

        <?php printHeader() ?> <!-- Imprime el Header -->

        <section style="padding: 20px;">
            <div style="overflow: auto; max-width: 1200px; margin: 0 auto;">
                <div style="float: left; margin-right: 20px;">
                    <img src="./img/PersonaSkate.webp" alt="Ropa de skate" style="width: 100%; max-width: 700px; height: auto;">
                </div>
                <div style="margin-top: 20px;">
                    <h2 style="text-align:center; color: #333333;">¡Encuentra el estilo que necesitas!</h2>
                    <p style="text-align:center; color: #555555; font-size: 18px;">En nuestra tienda, te ofrecemos una amplia selección de ropa de skate para que puedas expresar tu estilo único mientras practicas tu pasión por el skateboarding. Desde camisetas y sudaderas hasta pantalones y accesorios, tenemos todo lo que necesitas para lucir genial sobre tu tabla. Nuestra ropa está diseñada pensando en la comodidad, la durabilidad y el estilo, para que puedas destacar tanto en la pista como en la calle.</p>
                    <div style="text-align:center; margin-top: 20px;">
                        <a href="about.php" style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block,">Ver más...</a>
                    </div>
                </div>
            </div>
        </section>
    

        <main id="productos" style="margin-top: 100px; margin-bottom: 30px;">
            <div class="listado_productos">
                <div>
                    <a href="remeras.php">
                    <img src="./img/RemeraSection.jpg" alt="nose" width="600">
                    <br>
                    Ver mas remeras ..</a>
                </div>
                <div>
                    <a href="zapatillas.php">
                        <img src="./img/ZapatillaSection.jpg" alt="nose" width="600">
                    <br>
                    Ver mas Zapatillas ..</a>
                </div>
                <div>
                    <a href="buzos.php">
                    <img src="./img/BuzosSection.jpg" alt="nose" width="600">
                    <br>
                    Ver mas Buzos ..</a>
                </div>
            </div>
        </main>

        <?php printFooter() ?> <!-- Imprime el Footer -->

    </body>
</html>