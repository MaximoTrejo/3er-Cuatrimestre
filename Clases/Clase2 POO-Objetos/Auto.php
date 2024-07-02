<?php

class Auto  {

    private $_color;
    private $_marca;
    private $_precio;
    private $_fecha;

    public function __construct($marca,$color,$precio = null,$fecha=null){
            $this ->_marca =$marca;
            $this ->_color = $color;
            $this ->_precio = $precio;
            $this ->_fecha = $fecha;

            //valido que el precio si es null quede por defalult un 0
            if($this ->_precio  == null ){
                $this ->_precio = 0;
            }

            if($fecha instanceof DateTime){
                $this ->_fecha = $fecha;
            }else if(is_string($fecha)){
                $this-> _fecha = new DateTime ($fecha);
            }else{
                $this-> _fecha = new DateTime();
            } 
    }


    public function AgregarImpuestos($impuesto){
        if($this->_precio != null && $impuesto != null){
            $this-> _precio += $impuesto;
        }
    }

    public static function MostrarAuto($auto){
        echo "<br>Datos del auto:"
        ."<br>Marca ". $auto ->_marca
        ."<br>Color ". $auto ->_color
        ."<br>Precio ". $auto ->_precio
        ."<br>Precio ". $auto ->_fecha -> format("d-m-y"). "<br>";
    }

    public static function Equals($autoUno ,$autoDos){
        if($autoUno != null && $autoDos != null){
                if($autoUno->_marca ==$autoDos->_marca){
                    return true;
                }else{
                    return false;
                }
        }else{
            return false;
        }
    }

    public static function EqualsColor ($autoUno ,$autoDos){
        if($autoUno != null && $autoDos != null){
                if($autoUno->_color ==$autoDos->_color){
                    return true;
                }else{
                    return false;
                }
        }else{
            return false;
        }
    }

   

    public static function Add($autoUno, $autoDos) {
        $compMarca = Auto::Equals($autoUno,$autoDos);
        $compColor = Auto::EqualsColor($autoUno,$autoDos);


        if ($compMarca == true && $compColor == true) {

            $sumaPrecio = $autoUno->_precio + $autoDos->_precio;
            return $sumaPrecio;

        } else {
            return 0;
        }
    }

}