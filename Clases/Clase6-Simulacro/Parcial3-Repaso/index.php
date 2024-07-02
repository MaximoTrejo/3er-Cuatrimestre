<?php

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
        switch ($_POST['accion']) {

            case 'HamburguesaCarga':
                require_once './HamburguesaCarga.php';
                break;

            case 'HamburguesaConsultar':
                require_once './HamburguesaConsultar.php';
                break;

            case 'AltaVenta':
                require_once './AltaVenta.php';
                break;

            case 'ConsultasVentas':
                require_once './ConsultasVentas.php';
                break;

            case 'DevolverHamburguesa':
                require_once './DevolverHamburguesa.php';
                break;

            default:
                echo "Parametro accion no permitido";
                break;
        }
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $datos);
        switch ($datos['accion']) {
            case 'ModificarVenta':
                require_once './ModificarVenta.php';
                break;

            default:
                echo "Parametro accion no permitido";
                break;
        }
        break;

        
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $datos);
        switch ($datos['accion']) {
            case 'borrarVenta':
                require_once './borrarVenta.php';
                break;
        }
        break;



        
    default:
        echo "Verbo accion no permitido";
        break;
}