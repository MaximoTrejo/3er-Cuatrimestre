<?php

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
        switch ($_POST['accion']) {

            case 'TiendaAlta':
                require_once './TiendaAlta.php';
                break;

            case 'PrendaConsultar':
                require_once './PrendaConsultar.php';
                break;

            case 'AltaVenta':
                require_once './AltaVenta.php';
                break;

            case 'AltaConjunto':
                require_once './AltaConjunto.php';
                break;
            default:
                echo "Parametro accion no permitido";
                break;
        }
        break;

    case 'GET':
        switch ($_GET['accion']) {
            case 'ConsultasVentas':
                require_once './ConsultasVentas.php';
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
            case 'BorrarVenta':
                require_once './BorrarVenta.php';
                break;
        }
        break;
    

    default:
        echo "Verbo accion no permitido";
        break;
}