<?php

function printHeader(){
    echo '
    <header class="header">
        <div>
        <a href="index.php">
            <img src="./img/LogoHeader.png" width="50px" style="padding-left: 20px;">
        </a>
        </div>

        <nav style="margin-left: 30px">
            <a class="link_header" href="index.php">Home</a>
            <a class="link_header" href="index.php#productos">Productos</a>
            <a class="link_header" href="contacto.php">Contacto</a>
            <a class="link_header" href="about.php">Acerca de Nosotros</a>
            <a class="link_header" href="registro.php">Registrarse</a>
        </nav>

        <p class="nombre_marca">BlazeBoard</p>
    </header>
    ';
}

function printFooter(){
    echo'
    <footer class="footer">
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
    ';
}

function printFooterRegistro(){
    echo'
    <footer class="footer" style="margin-top: auto;">
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
    ';
}



?>