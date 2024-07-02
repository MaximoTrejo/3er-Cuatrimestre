<?php

require_once './auto.php.php';

class AutoBD extends Auto{

    private $_color;
    private $_marca;
    private $_precio;
    private $_fecha;

    private $_pathFoto;


    public function __construct($patente , $marca ,$color,$precio,$pathFoto)    
    {
        parent::__construct($patente , $marca ,$color,$precio);
        $this->_pathFoto = $pathFoto;
    }



    

}
