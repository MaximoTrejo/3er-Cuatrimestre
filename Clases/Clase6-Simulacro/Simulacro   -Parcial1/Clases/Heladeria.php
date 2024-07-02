<?php

class Heladeria{ 

    public $_sabor;
    private $_precio;
    public $_tipo;
    public $_vaso;
    public $_stock;


    public function __construct($sabor , $precio =null ,$tipo,$vaso=null,$stock = null){

        $this->_precio=$precio;
        $this->_sabor=$sabor;
        $this->_tipo=$tipo;
        $this->_vaso =$vaso;
        $this->_stock=$stock;

        if($this ->_precio  == null ){
            $this ->_precio = 0;
        }

    }

    public static function guardarHeladeria($arrayHeladeria){
        $exito = false;
        //abre el archiivo
        $archivo = fopen("heladeria.json", "w");
        //cadena en la que se escribiran los datos del archivo
        if($archivo){
            $helados = array();
            foreach ($arrayHeladeria as $helado){
                $auxHelado = get_object_vars($helado);
                array_push( $helados ,$auxHelado);
            }
            fputs($archivo, json_encode($helados));
            fclose($archivo);
            $exito=true;
        }
        //escribe algo en la pantalla 
        if(!$exito) {
            echo "<p>¡Algo salió mal!</p>";
        }
    }

    public static function crearImagen($carpeta_archivos, $arrayHeladeria, $archivoHeladoTemp, $nombvremalo) {

        $extension = pathinfo($nombvremalo, PATHINFO_EXTENSION);

        if(isset($arrayHeladeria)){

            $totalHelados = count($arrayHeladeria);

            for ($i = $totalHelados - 1; $i >= 0; $i--) {
                
                $helado = $arrayHeladeria[$i];
                $nombre_archivo = $helado->_sabor . " - " . $helado->_tipo . ".";
                $ruta_destino = $carpeta_archivos . time() . $nombre_archivo . $extension;
        
                if (move_uploaded_file($archivoHeladoTemp, $ruta_destino)) {
                    echo "\n".'Imagen : El archivo ha sido cargado correctamente: ' . $nombre_archivo;
                    break;
                }
            }
        }else{
            echo "No se puede guardar la imagen de la venta a una heladeria que no existe ";
        }
    }

    public  static  function  buscarHeladerasIguales($sabor,$tipo,$arrayHelados){
        $existe=  -1;
        foreach ($arrayHelados as $key => $helado){
            if($helado->_sabor == $sabor  && $helado->_tipo == $tipo){
                $existe = true;
                return $key;
            }
        }
        return $existe;
    }

    public static function validarHeladerasIguales($sabor, $tipo, $arrayHelados) {
        // Utilizar la función buscarHeladerasIguales para comprobar si el helado existe
        $heladoKey = Heladeria::buscarHeladerasIguales($sabor,$tipo,$arrayHelados);
        if($heladoKey != -1){
            return "existe";
        }else{
            return "no existe";
        }
    }

    public static function agregarHeladeria($sabor, $precio , $tipo,$Vaso,$stock,$arrayHelados){
        $existe = false;
        //valido que el array no este vacio
        if (!empty($arrayHelados)) {
            //recorro el array

            $heladoKey = Heladeria::buscarHeladerasIguales($sabor,$tipo,$arrayHelados);

            if($heladoKey != -1){

                $heladoIgualEncontrado= $arrayHelados[$heladoKey];
                
                if(isset($heladoIgualEncontrado) && isset($precio)){

                    $heladoIgualEncontrado->_precio = $precio + $heladoIgualEncontrado->_precio;
                    $heladoIgualEncontrado->_stock = $stock + $heladoIgualEncontrado->_stock;
    
                    $existe = true;
                    echo "Agregar: Se modifico el precio y el stock ya que la heladeria ya existe ";
                }else{
                    echo "Algo salio mal";
                }
            }
        }
        //si la heladera no existe la creo 
        if(!$existe){
            $heladeria = new Heladeria($sabor, $precio , $tipo,$Vaso,$stock );
            array_push($arrayHelados ,$heladeria);
            echo "Agregar: Se agrego la heladeria";

        }
        //retorno un array de heladeras
        return $arrayHelados;
    } 

    public static function leerJson($ruta){


        if (!file_exists($ruta)) {
            // Si el archivo no existe, intenta crearlo
            $archivo = fopen($ruta, 'w');
            fclose($archivo);
            $arrayHelados=array();
            return $arrayHelados;
        }else{
            // Abre el archivo en modo lectura
            $archivo = fopen($ruta,'r');
            // Lee el contenido del archivo en una cadena
            $contenido = fread($archivo, filesize($ruta));
        
            // transforma  el JSON
            $data = json_decode($contenido, true);
        
            // Array para almacenar Heladerias
            $arrayHeladerias = array();
        
            // Recorrer los datos y crear Heladerias
            foreach ($data as $heladeriaData) {
                // Crear una instancia de Heladeria con los datos del JSON
                $heladeria = new Heladeria(
                    $heladeriaData['_sabor'],
                    $heladeriaData['_precio'],
                    $heladeriaData['_tipo'],
                    $heladeriaData['_vaso'],
                    $heladeriaData['_stock']
                );
                
                // Agregar la instancia de Heladeria al array
                array_push($arrayHeladerias, $heladeria);
            }
        
            // Cierra el archivo
            fclose($archivo);
        
            // Retornar el array de Heladerias
            return $arrayHeladerias;
        }

    }



}