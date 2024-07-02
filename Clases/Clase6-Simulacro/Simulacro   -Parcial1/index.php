<?php


    switch ($_SERVER['REQUEST_METHOD']) {
        
        case 'POST':
            switch ($_POST['accion']) {
                case 'HeladeriaAlta':
                    require_once './HeladeraAlta.php';
                    break;

                case 'HeladeriaConsulta1':
                    require_once './HeladeriaConsulta.php';
                    break;

                case 'AltaVenta':
                    require_once './AltaVenta.php';
                    break;

                case 'ModificarVenta':
                    require_once './ModificarVenta.php';
                    break;

                case 'borrarVenta':
                    require_once './borrarVenta.php';
                    break;

                case 'DevolverHelado':
                    require_once './DevolverHelado.php';
                    break;


                default:
                    echo "Parametro accion no permitido";
                    break;
                
            }
            break;

        
        case 'GET':
            switch ($_GET['accion']) {
                case 'ConsultasVentas':
                    require_once "./ConsultasVentas.php";
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
        default:
            echo "Verbo accion no permitido";
            break;
    }
