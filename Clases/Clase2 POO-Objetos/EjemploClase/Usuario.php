<?php

class Usuario {

    //atributos
    public $nombre ;
    public $apellido;

    //atributos estaticos
    public  static $contador=0;

    public function __construct($nombre,$apellido =null) {
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        self::$contador++;
    }

    //metodo
    public function mostrar() {

        return $this->nombre ."". $this ->apellido;
    }
    //metodo estatico
    public static function cantidadUsuarios() {
        return self::$contador;
    }

}
?>
