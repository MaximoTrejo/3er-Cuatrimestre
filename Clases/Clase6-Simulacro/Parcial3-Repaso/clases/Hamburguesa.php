<?php

class Hamburguesa{

    public $_nombre;
    public $_precio;
    public $_tipo;
    public $_aderezo;
    public $_cantidad;

    //Generico
    public $_id_autoincremental; // Atributo de instancia para el número de pedido
    public static $_id_autoincremental_counter = 0; // Contador de pedidos

    public function __construct($nombre,$precio,$tipo,$aderezo,$cantidad){

        $this->_nombre = $nombre;
        $this->_precio = $precio;
        $this ->_tipo = $tipo;
        $this ->_cantidad =$cantidad;
        $this->_aderezo =$aderezo;
        //Generico
        self::$_id_autoincremental_counter++;
        $this->_id_autoincremental = self::$_id_autoincremental_counter;
        
    }
    //Generico
    public static function cantidad_id() {
    return self::$_id_autoincremental_counter;
    } 

    //PRIMERA PARTE

    //no es generica
    public static function leerJson($ruta){
        if (!file_exists($ruta)) {
            // Si el archivo no existe, intenta crearlo
            $archivo = fopen($ruta, 'w');
            fclose($archivo);
            $arrayObjs=array();
            return $arrayObjs;
        }else{
            // Abre el archivo en modo lectura
            $archivo = fopen($ruta,'r');
            // Lee el contenido del archivo en una cadena
            $contenido = fread($archivo, filesize($ruta));
        
            // transforma  el JSON
            $data = json_decode($contenido, true);
        
            // Array para almacenar Heladerias
            $arrayObjs=array();
        
            // Recorrer los datos y crear Heladerias
            foreach ($data as $objData) {

                // Crear una instancia de Heladeria con los datos del JSON


                //PARTE NO GENERICA
                $obj = new Hamburguesa(
                    $objData['_nombre'],
                    $objData['_precio'],
                    $objData['_tipo'],
                    $objData['_aderezo'],
                    $objData['_cantidad'],
                );
                //PARTE NO GENERICA
                



                // Agregar la instancia de Heladeria al array
                array_push($arrayObjs, $obj);
            }
        
            // Cierra el archivo
            fclose($archivo);
        
            // Retornar el array de Heladerias
            return $arrayObjs;
        }

    }
    public  static  function  buscarIguales($nombre,$tipo,$array_objs){
        $existe=  -1;
        foreach ($array_objs as $key => $obj){

            //PARTE NO GENERICA
            if($obj->_nombre == $nombre  && $obj->_tipo == $tipo){
                $existe = true;
                return $key;
            }
            //PARTE NO GENERICA
        }
        return $existe;
    }
    public static function agregarObjets($nombre, $precio , $tipo,$aderezo,$cantidad,$arrayObjs){
        $existe = false;
        //valido que el array no este vacio
        if (!empty($arrayObjs)) {

            //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
            $objsKey = Hamburguesa::buscarIguales($nombre,$tipo,$arrayObjs);
            //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
            if($objsKey != -1){

                $objsEncontrado= $arrayObjs[$objsKey];
                
                //el isset($precio) no es generico
                if(isset($objsEncontrado) && isset($precio)){

                    //parte no generica
                    $objsEncontrado->_precio = $precio + $objsEncontrado->_precio;
                    $objsEncontrado->_cantidad = $cantidad + $objsEncontrado->_cantidad;
                    $existe = true;
                    echo "Agregar: Se modifico el precio y el stock porque ya existe ";
                }else{
                    echo "Algo salio mal";
                }
            }
        }

        //si la heladera no existe la creo 
        if(!$existe){

            //parte no generica
            $obj = new Hamburguesa($nombre, $precio , $tipo,$aderezo,$cantidad );
            array_push($arrayObjs ,$obj);
            echo "Agregar: Se agrego ";

        }
        return $arrayObjs;





    }

    public static function crearImagen($carpeta_archivos, $array_objs, $archivoTemp, $nombreArchivo) {

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        if(isset($array_objs)){

            $total = count($array_objs);

            for ($i = $total - 1; $i >= 0; $i--) {
               
                $obj = $array_objs[$i];

                //PARTE NO GENERICA
                $nombre_archivo = $obj->_nombre . " - " . $obj->_tipo . ".";
                //PARTE NO GENERICA

                $ruta_destino = $carpeta_archivos. $nombre_archivo . $extension;
        
                if (move_uploaded_file($archivoTemp, $ruta_destino)) {
                    echo "\n".'Imagen : El archivo ha sido cargado correctamente: ' . $nombre_archivo;
                    break;
                }
            }
        }else{
            echo "\n"."No se puede guardar la imagen debido a que no existe ";
        }
    }

    public static function guardarJSON($array_objs,$nombre_archivo){
        $exito = false;
        //abre el archiivo
        $archivo = fopen($nombre_archivo, "w");
        //cadena en la que se escribiran los datos del archivo
        if($archivo){
            $aObjs = array();
            foreach ($array_objs as $obj){
                $auxObj = get_object_vars($obj);
                array_push( $aObjs ,$auxObj);
            }
            fputs($archivo, json_encode($aObjs));
            fclose($archivo);
            $exito=true;
        }
        //escribe algo en la pantalla 
        if(!$exito) {
            echo "<p>¡Algo salió mal!</p>";
        }
    }

    public static function consultaIguales($nombre, $tipo, $array_objs) {
        
        if(isset($array_objs)){
           //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
            $Key = Hamburguesa::buscarIguales($nombre,$tipo,$array_objs);
            //PARTE NO GENERICA 

            if($Key != -1){
                return "existe";
            }else{
                return "no existe";
            }
        }else{
            echo"No se leyo bien el JSON";
        }
        


    }



}


