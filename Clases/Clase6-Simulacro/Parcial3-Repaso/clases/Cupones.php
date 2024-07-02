<?php

class Cupones{ 

    public $_id_devolucion;
    public static $_id_devolucion_counter=0;
    public $_porcentaje;
    public $_estado;
    public $_numero_pedido;


    public function __construct($porcentaje,$estado,$numero_pedido){

        $this->_porcentaje=$porcentaje;
        $this->_estado=$estado;
        $this -> _numero_pedido = $numero_pedido;

        self::$_id_devolucion_counter++;
        $this->_id_devolucion = self::$_id_devolucion_counter;
    }

    public static function cantidad_id() {
        return self::$_id_devolucion_counter;
    }  

    public static function crearCupon($aVenta, $numero_pedido){

        $Key = venta::buscarVenta($numero_pedido,$aVenta);

        if($Key!= -1){

            $venta =$aVenta[$Key];

            $aCupon = array();

            $cupon = new Cupones((int)10 , "no usado", $venta ->_id_autoincremental);

            array_push($aCupon, $cupon);
            
            echo "\n"."El cupon se creo";
            return $aCupon; 
        }else{
            Echo"\n"."El cupon no es posible crearlo";
        }
    }

    public static function guardarCupon($aObjs)
    {
        if (isset($aObjs)) {
            //abre el archiivo
            $archivo = fopen("cupon.json", "w");
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


}