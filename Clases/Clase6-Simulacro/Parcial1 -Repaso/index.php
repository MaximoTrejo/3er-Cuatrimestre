<?php


switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
        switch ($_POST['accion']) {
            case 'altaAuto':
                require_once './altaAutoJSON.php';
                break;
            case 'verificarAuto':
                require_once './verificarAutoJSON.php';
                break;  
            
            default:
                echo "Parametro accion no permitido";
                break;
        }
        break;

    case 'GET':
        switch ($_GET['accion']) {
            case 'listadoAuto':
                require_once './listadoAutosJSON.php';
                break;
        }
        break;


    default:
        echo "Verbo accion no permitido";
        break;
}
