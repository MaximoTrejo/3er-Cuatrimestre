<?php



switch ($_SERVER['REQUEST_METHOD']) {
        
    case 'POST':
        switch ($_POST['accion']) {

            case 'PizzaCarga':
                require_once './PizzaCarga.php';
                break;

            case 'PizzaConsultar':
                require_once './PizzaConsultar.php';
                break;

            case 'AltaVenta':
                require_once './AltaVenta.php';
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

            default:
                echo "Parametro accion no permitido";
            break;
        }
        break;
    default:
    echo "Verbo accion no permitido";
    break;
}