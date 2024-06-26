<?php include "funciones.php"?>

<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/IconoWeb.ico">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Registrados</title>
  </head>

  <body style="margin: 0px; min-height: 100vh;">

    <?php printHeader() ?> <!-- Imprime el Header -->

    <main style="flex: 1;">

      <h1 style="text-align: center;">
        Información del cliente resgistrado
      </h1>

      <table class="tabla_registro">
        <tr>
          <th class="celda_tabla_registro">Form Field</th>
          <th class="celda_tabla_registro">Field Value</th>
        </tr>

        <script language="javascript">
        var args = location.search.substr(1).split('&');
        for (var i = 0; i < args.length; ++i) {
          var parts = args[i].split('=');
          if (parts != null) {
            var field = parts[0];
            var value = parts[1];
            if (value == null) {
              value = "null"
            }
            else {
              value = '"' + unescape(value.replace(/\+/g, ' ')) + '"';
            }

            document.writeln('<tr><td class="celda_tabla_registro">' + field + '</td>');
            document.writeln('<td class="celda_tabla_registro">' + value + '</td></tr>');
          }
        }
        </script>
          <noscript>
            <tr>
              <td>
                <p>You need to turn on Javascript in your browser.</p>

                <p>In Microsoft Internet Explorer 4 or greater:</p>
                <ul>
                <li>From the "Tools" menu (in IE 4, it's the "View" menu), select "Internet Options".</li>
                <li>Click on the "Security" tab.</li>
                <li>Click on the "Custom Level" button. (In IE 4, select "Custom"
                and then click on "Settings...".)</li>
                <li>Under "Active scripting" make sure "Enable" is selected.</li>
                </ul>

                <p>In Netscape version 4 or greater:</p>
                <ul>
                <li>From the <b>Edit</b> menu, select <b>Preferences</b>.</li>
                <li>In the <b>Category</b> list on the left, click on the word "Advanced".</li>
                <li>In the panel on the right, make sure "Enable JavaScript" is checked.</li>
                <li>Click the <b>OK</b> button.</li>
              </ul>
              
            </td>
          </tr>
        </noscript>
      </table>
    
    </main>
    
    <footer class="footer" style="position: fixed; bottom: 0;">
        <div style="padding-left: 20px;">
            <h3 class="h3_footer">Nosotros</h3>
            <ul style="list-style-type: none; padding: 0;">
                <li><a class="link_footer" href="contacto.php">Contacto</a></li>
                <li><a class="link_footer" href="about.php">Acerca de nosotros</a></li>
            </ul>
        </div>
        <div>
            <h3 class="h3_footer">Marcas</h3>
            <ul style="list-style-type: none; padding: 0;">
                <li>Vans</li>
                <li>DC</li>
                <li>Circa</li>
                <li>Santa Cruz</li>
            </ul>
        </div>
        <div >
            <h3 class="h3_footer">Políticas/Condiciones</h3>
            <ul style="list-style-type: none; padding: 0;">
                <li><a class="link_footer" href="preguntasFrecuentes.php">Preguntas Frecuentes</a></li>
                <li><a class="link_footer" href="basesCondicion.php">Bases y Condiciones</a></li>
            </ul>
        </div>

        <div style="margin-right: 20px;">
            <h3 class="h3_footer">Redes sociales</h3>
            <ul style="list-style-type: none; padding: 0;">
                <li style="display: inline-block; margin-right: 10px;">
                <a href="https://www.instagram.com/"><img src="./img/LogoInstagram.png" width="40px"></a>
                </li>
                <li style="display: inline-block; margin-right: 10px;">
                <a href="https://www.whatsapp.com/"><img src="./img/LogoWhatsapp.png" width="40px"></a>
                </li>
                <li style="display: inline-block;">
                <a href="https://twitter.com/"><img src="./img/LogoX.png" width="40px"></a>
                </li>
            </ul>
        </div>
        <div style="flex-basis: 100%;">
            <p style="text-align: center;">Derechos reservados 2025 &copy;</p>
        </div>
    </footer>

  </body>
</html>