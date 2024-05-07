<?php include "funciones.php"?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./img/IconoWeb.ico">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>Remeras</title>

    </head>
    
    <body style="margin: 0px;">
    
        <?php printHeader() ?> <!-- Imprime el Header -->

        <main>
            <h1 style="padding-left: 20px;">Remeras</h1>
            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/remera_1.jpg" alt="remera_dc" width="300" height="300"  >
                <ul>
                    <h2>Remera Dc Tracer Amarillo </h2>
                    <h3>Precio $31990</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: 
                        <ul>
                            <li>TELA 100% Algodón </li>
                            <li>Remera manga corta</li>
                            <li>Tejido: Jersey 30.1 Melange</li>
                            <li>Fit: Regular</li>
                            <li>Avios DC</li>
                        </ul>
                    </p>
                </ul>

            </article>

            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/remera_2.jpg" alt="remera_dc" width="300" height="300"  >
                <ul>
                    <h2>Remera Circa Escape Gris</h2>
                    <h3>Precio $21490</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: Esta Remera Circa Escape Gris tiene un estilo de manga corta con una estampa en la parte frontal. Está fabricada completamente en algodón y ha sido confeccionada en Argentina. 
                        <ul>
                            <li>Remera manga corta </li>
                            <li>Estampa en la parte frontal</li>
                            <li>100% Algodón</li>
                            <li>Avios Circa</li>
                        </ul>
                    </p>
                </ul>
            </article>

            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/remera_3.jpg" alt="remera_dc" width="300" height="300"  >
                <ul>
                    <h2>Remera Santa Cruz Kendall Eotw Blanco</h2>
                    <h3>Precio $29900</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: Camiseta de manga corta para hombre de ajuste regular con una serigrafía del punto 'End Of The World' de Jeff Kendall.
                        <ul>
                            <li>TELA 100% Algodón </li>
                            <li>Remera manga corta</li>
                            <li>Avios Santa cruz</li>
                        </ul>
                    </p>
                </ul>
            </article>

            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/remera_4.jpg" alt="remera_dc" width="300" height="300"  >
                <ul>
                    <h2>Remera Vans Full Patch Back Naranja </h2>
                    <h3>Precio $34990</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: La camiseta Vans Full Patch Back te cubre de costa a costa y de todo el mundo. Las serigrafías de Vans se encuentran en el lado izquierdo del pecho y en la espalda. Hecha de 100% algodón, esta camiseta ofrece un uso ligero y cómodo. Además, cuenta con una etiqueta tejida en la manga izquierda y un cómodo cuello interior protegido.
                        <ul>
                            <li>TELA 100% Algodón </li>
                            <li>Serigrafías de Vans en el lado izquierdo del pecho y en la espalda</li>
                            <li>Etiqueta tejida en la manga izquierda</li>
                            <li>Cuello interior protegido</li>
                            <li>Avios VANS</li>
                        </ul>
                    </p>
                </ul>
            </article>
        </main>

        <?php printFooter() ?> <!-- Imprime el Footer -->
        
    </body>
</html>