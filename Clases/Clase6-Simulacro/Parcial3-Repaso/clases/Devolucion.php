<?php


class Devolucion{ 

    public $_numero_pedido;
    public $_motivo;


    public function __construct($numero_pedido,$motivo){

        $this->_numero_pedido=$numero_pedido;
        $this->_motivo=$motivo;

    }


    public static function DevolverHelado($aVenta, $numero_pedido,$motivo ){

        $Key = venta::buscarVenta($numero_pedido,$aVenta);

        if($Key != -1){
            $aDevolucion = array();
            $devolucion = new Devolucion($numero_pedido,$motivo);
            array_push($aDevolucion, $devolucion);
            echo "\n"."La devolucion se cargo correctamente";
            return $aDevolucion;

        }else{
            echo "\n"."El numero de la venta no existe";
        }
    }

    public static function guardarDevolucion($aObjs){
        if (isset($aObjs)) {
            //abre el archiivo
            $archivo = fopen("devolucion.json", "w");
            //cadena en la que se escribiran los datos del archivo
            if ($archivo) {
                $objs = array();

                foreach ($aObjs as $obj) {

                    $auxObj = get_object_vars($obj);

                    array_push($objs, $auxObj);
                }
                fputs($archivo, json_encode($objs));
                fclose($archivo);
            }
        } else {
            echo "<p>¡Algo salió mal!</p>";
        }
    }

    public static function crearImagen($carpeta_archivos, $arrayObjs, $archivoTemp, $nombreArchivo) {

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        if(isset($arrayObjs)){

            $totalObjs = count($arrayObjs);

            for ($i = $totalObjs - 1; $i >= 0; $i--) {
                $obj = $arrayObjs[$i];

                //cambiar
                $nombre_archivo =  $obj->_numero_pedido . ".";
                //cambiar
    
                $ruta_destino = $carpeta_archivos . $nombre_archivo . $extension;
                if (move_uploaded_file($archivoTemp, $ruta_destino)) {
                    echo "\n".'Imagen : El archivo ha sido cargado correctamente: ' . $nombre_archivo;
                    break;
                }
            }
        }else{
            echo "\n"."No se puede guardar la imagen ";
        }

    }
}