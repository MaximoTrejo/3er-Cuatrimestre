<?php

class Auto{

    private $_patente;
    private $_marca;
    private $_color;
    private $_precio;

    public function __construct($patente , $marca ,$color,$precio){

        $this->_precio=$precio;
        $this->_patente = $patente;
        $this->_color=$color;
        $this->_marca =$marca;

        if($this ->_precio  == null ){
            $this ->_precio = 0;
        }

    }



    public static function guardarJSON($path , $patente ,$marca ,$color,$precio){
        $exito = false;
        //abre el archiivo
        $archivo = fopen($path, "w");
        //cadena en la que se escribiran los datos del archivo
        if($archivo){
            $arrayObjetos = array();
            $obj = new Auto($patente, $precio , $marca,$color);
            $auxObj = get_object_vars($obj);
            array_push($arrayObjetos ,$auxObj);
            fputs($archivo, json_encode($arrayObjetos));
            fclose($archivo);
            $exito=true;
            return $exito;
        }else{
            echo "<p>¡Algo salió mal al leer el archivo!</p>";
            return $exito;
        }
    }


    public static function traerJson($path){
        if (!file_exists($path)) {
            // Si el archivo no existe, intenta crearlo
            $archivo = fopen($path, 'w');
            fclose($archivo);
            $arrayHelados=array();
            return $arrayHelados;
        }else{
            // Abre el archivo en modo lectura
            $archivo = fopen($path,'r');
            // Lee el contenido del archivo en una cadena
            $contenido = fread($archivo, filesize($path));
        
            // transforma  el JSON
            $data = json_decode($contenido, true);
        
            // Array para almacenar Heladerias
            $arrayObjetos = array();
        
            // Recorrer los datos y crear Heladerias
            foreach ($data as $objData) {
                // Crear una instancia de Heladeria con los datos del JSON
                $objeto = new Auto(
                    $objData['_patente'],
                    $objData['_precio'],
                    $objData['_marca'],
                    $objData['_color'],
                );  
                // Agregar la instancia de Heladeria al array
                array_push( $arrayObjetos, $objeto);
            }
        
            // Cierra el archivo
            fclose($archivo);
        
            // Retornar el array de Heladerias
            return $arrayObjetos;
        }

    }



    public static function verificarAutoJSON($auto,$path){

        $existe = false;

        $arrayObjetos = Auto::traerJson($path );

        if (!empty($arrayObjetos)) {
            //recorro el array
            foreach ($arrayObjetos as $obj){
                if($obj->_patente == $auto){
                    $existe = true;
                    return $existe;
                }
            }
        }else{
            $existe = false;
            return $existe;
        }

    }



    public static function MostrarAuto($Array){
        foreach($Array as $auto){
            echo "\n Datos del auto:"
            ."\nMarca ". $auto ->_patente
            ."\nColor ". $auto ->_precio
            ."\nPrecio ". $auto ->_color
            ."\nPrecio ". $auto ->_marca ."\n";
        }
    }
}
