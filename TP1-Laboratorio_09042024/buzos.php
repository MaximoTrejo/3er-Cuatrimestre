<?php include "funciones.php"?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./img/IconoWeb.ico">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>Buzos</title>

    </head>
    <body style="margin: 0px;">

        <?php printHeader() ?> <!-- Imprime el Header -->

        <main>
            <h1  style="padding-left: 20px;">Buzos</h1>
            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/buzo_1.jpg" alt="buzo_circa" width="300" height="300"  >
                <ul>
                    <h2>Buzo Circa Commit Ranglan Gris Melange</h2>
                    <h3>Precio $58990</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: Buzo de friza esmerilada, con bolsillo frontal tipo canguro y capucha forrada en jersey a tono. Ojalillos metálicos, cordón plano a tono y puños de ribb. Estampa en el frente a un color. Avíos personalizados. Corte.</p>
                </ul>

            </article>

            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/buzo_2.jpg" alt="buzo_dc" width="300" height="300"  >
                <ul>
                    <h2>Buzo Dc Crew Concrete Verde</h2>
                    <h3>Precio $50400</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: 
                        El buzo DC Crew Concrete es una prenda cómoda y estilosa para cualquier ocasión. Fabricado con 100% algodón y tejido de frisa pesada, este buzo de cuello redondo ofrece durabilidad y comodidad.
                    </p>
                    <ul>
                        <li>Tela: Frisa pesada</li>
                        <li>Fit: Regular              </li>
                        <li>Estampa en el pecho y espalda con detalles de Avios DC</li>
                    </ul>
                </ul>
            </article>

            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/buzo_3.jpg" alt="buzo_santaCruz" width="300" height="300"  >
                <ul>
                    <h2>Buzo Santa Cruz Rustic Batik Multicolor</h2>
                    <h3>Precio $44900</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: El buzo con capucha Santa Cruz Batik es una prenda de estilo único y llamativo. Con múltiples etiquetas que le añaden un toque de autenticidad, este buzo cuenta con cordones de algodón para ajustar la capucha según tu preferencia. Presenta una estampa en el delantero y la espalda, agregando un toque de estilo y personalidad. Fabricado con frisa, te brinda calidez y comodidad en días frescos. Este buzo con capucha es perfecto para aquellos que buscan un look moderno y original.</p>
                </ul>
            </article>

            <article style="border: 2px solid black; padding: 20px; margin: 20px; display: flex; ">
                <img src="./img/buzo_4.jpg" alt="buzo_vans" width="300" height="300"  >
                <ul>
                    <h2>Buzo Vans Classic Crew II Negro</h2>
                    <h3>Precio $49900</h3>
                    <select name="talle" id="talle">
                        <option disabled selected value>elija una opcion</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button>Añadir al carrito</button>
                    <p>Descripcion: 
                        Este Buzo Vans Classic Crew II Negro con escote redondo está confeccionado en frisa, ofreciendo calidez y comodidad. Presenta una estampa llamativa en el frente que agrega un toque de estilo. Incluye una etiqueta de marca y talle para mayor información y autenticidad. La grifa Vans asegura calidad y autenticidad. Cuenta con una cinta interior personalizada, proporcionando un detalle único y distintivo. Este buzo combina moda y funcionalidad para un look casual y a la moda.
                    </p>
                    <ul>
                        <li>Buzo con escote redondo en frisa</li>
                        <li>Estampa en el frente </li>
                        <li>Etiqueta de marca y talle</li>
                        <li>Grifa Vans</li>
                        <li>Cinta interior personalizada</li>
                    </ul>
                </ul>
            </article>
        </main>

        <?php printFooter() ?> <!-- Imprime el Footer -->
        
    </body>
</html>