<?php 

require_once './Usuario.php';
class Empleado extends Usuario{

    //atributos
    public $nombre ;
    public $apellido;
    public $sector;

    //constructor 

    public function __construct( $nombre, $apellido = null, $sector=null )    
    {
        parent::__construct($nombre,$apellido);
        $this->sector = $sector;
    }


}
