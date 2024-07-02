<?php

require_once './clases/Hamburguesa.php';


class Venta{

    public $_nombre;
    public $_tipo;
    public $_aderezo;
    public $_cantidad;
    public $_mail;
    public $_fecha;
     //Generico
     public $_id_autoincremental; // Atributo de instancia para el número de pedido
     public static $_id_autoincremental_counter = 0; // Contador de pedidos

    public function __construct($nombre ,$tipo,$aderezo,$cantidad, $mail ,$fecha){

        $this->_nombre=$nombre;
        $this->_tipo=$tipo;
        $this ->_aderezo = $aderezo;
        $this->_cantidad=$cantidad;
        $this->_mail = $mail;
        $this->_fecha = $fecha;


        //Generico
        self::$_id_autoincremental_counter++;
        $this->_id_autoincremental = self::$_id_autoincremental_counter;
    }

    //Generico
    public static function cantidad_id() {
        return self::$_id_autoincremental_counter;
    }  
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
                $obj = new Venta(
                    $objData['_nombre'],
                    $objData['_tipo'],
                    $objData['_aderezo'],
                    $objData['_cantidad'],
                    $objData['_mail'],
                    $objData['_fecha'],
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
    public static function altaObjs($nombre, $tipo ,$cantidad,$mail,$aPrincipal,$aSecundario , $nombreJson){

        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
        $Key = Hamburguesa::buscarIguales($nombre, $tipo,$aPrincipal);
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)

        $exito = false;

        if ($Key != -1 && isset($aSecundario)) {

            $obj_buscado = $aPrincipal[$Key];

            //cambiar cantidad 
            $cuenta = $obj_buscado->_cantidad - $cantidad;

            if ($cuenta >= 0) { // Verificar que no se vendan más de lo que se tiene
                //cambiar cantidad
                $obj_buscado->_cantidad = $cuenta;

                //PARTE NO GENERICA(se debe cambiar por la funcion indicando el objeto correcto)
                Hamburguesa::guardarJSON($aPrincipal,$nombreJson);
                //PARTE NO GENERICA(se debe cambiar por la funcion indicando el objeto correcto)


                $hoy = new DateTime();
                $fechahoy = $hoy -> format('y-m-d');

                //PARTE NO GENERICA
                $obj = new Venta($obj_buscado->_nombre , $obj_buscado->_tipo  ,$obj_buscado->_aderezo,$cuenta,$mail, $fechahoy);
                //PARTE NO GENERICA


                array_push($aSecundario, $obj);
                
                echo "Agregar: Se agrego correctamente";
                return $aSecundario;
            }else{
                echo "No podes vender mas de lo que tenes";
                return $exito;
            }
        }else{
            echo " No se puede hacer una venta a una heladeria que no existe";
        }
    }
    public static function crearImagen($carpeta_archivos, $array_objs, $archivoTemp, $nombreArchivo) {

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        if(isset($array_objs)){

            $total = count($array_objs);

            for ($i = $total - 1; $i >= 0; $i--) {
               
                $obj = $array_objs[$i];

                //PARTE NO GENERICA
                $nombre_archivo = $obj->_nombre . " - " . $obj->_tipo . " - " . $obj->_mail. ".";
                //PARTE NO GENERICA

                $ruta_destino = $carpeta_archivos. $nombre_archivo . $extension;
        
                
                if (move_uploaded_file($archivoTemp, $ruta_destino)) {
                    echo "\n".'Imagen : El archivo ha sido cargado correctamente: ' . $nombre_archivo;
                    break;
                }else{
                    echo"No se cargo correctamente el archivo ";
                }
            }
        }else{
            echo "\n"."No se puede guardar la imagen ";
        }
    }



    //consultas

    public static function buscarCantidadFecha($fecha_recibida , $arrayObjs ){
        $cont= 0;

        foreach($arrayObjs as $obj){

            if($obj ->_fecha == $fecha_recibida->format('y-m-d') ){
                $cont++;
            }

        }
        return $cont;
    }

    public static function consultaFecha($fecha_recibida , $arrayObjs){

        $ContVentas= Venta::buscarCantidadFecha($fecha_recibida,$arrayObjs);

        if($ContVentas >= 0){
            echo "\n Cantidad  Vendida en ". $fecha_recibida->format('y-m-d')
            ."\n Vendido : ". $ContVentas."\n";
        }else{
            echo "No se vendio nada";
        }
    } 

    public static function buscarEntreFechas($fechaHasta , $fechaDesde ,$arrayObjs ){
        $existe= -1;
        foreach($arrayObjs as $key=>$obj){
            if($obj ->_fecha >= $fechaDesde && $obj ->_fecha <= $fechaHasta){
                return $key;
            }
        }
        return $existe;
    }

    public static function consultaEntreFechas($fechaHasta , $fechaDesde ,$arrayObjs ){
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
        $objEncontradaKey = Venta::buscarEntreFechas($fechaHasta , $fechaDesde ,$arrayObjs);
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
        
        if($objEncontradaKey != -1){

            $ObjEncontrado = $arrayObjs[$objEncontradaKey];
            Venta::MostrarDatos($ObjEncontrado);
        }else{
            echo "\n No se encontraron ventas desde " . $fechaDesde ." hasta " . $fechaHasta;
        }
    }

    public static function buscarTipo($Tipo,$arrayObjs ){
        $existe= -1;
        foreach($arrayObjs as $key=>$obj){
            if($obj ->_tipo >= $Tipo){
                return $key;
            }
        }
        return $existe;
    }

    public static function consultaPorTipo ($Tipo,$arrayObjs){
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
            $objEncontradaKey = Venta::buscarTipo($Tipo,$arrayObjs);
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
            if($objEncontradaKey != -1){
        
                $ObjEncontrado = $arrayObjs[$objEncontradaKey];
                Venta::MostrarDatos($ObjEncontrado);
            }else{
                echo "\n No se encontraron con el sabor " . $Tipo;
            }
    }

    public static function buscarAderezo($aderezo,$arrayObjs ){
        $existe= -1;
        foreach($arrayObjs as $key=>$obj){
            if($obj ->_tipo >= $aderezo){
                return $key;
            }
        }
        return $existe;
    }

    public static function consultaAderezo ($aderezo,$arrayObjs){
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
            $objEncontradaKey = Venta::buscarAderezo($aderezo,$arrayObjs);
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
            if($objEncontradaKey != -1){
        
                $ObjEncontrado = $arrayObjs[$objEncontradaKey];
                Venta::MostrarDatos($ObjEncontrado);
            }else{
                echo "\n No se encontraron con el sabor " . $aderezo;
            }
    }

    public static function MostrarDatos($obj){
        echo "\n Datos del venta:"
        ."\nNumero Pedido ". $obj ->_id_autoincremental
        ."\nNombre ". $obj ->_nombre
        ."\nTipo ". $obj ->_tipo
        ."\nFecha ". $obj ->_fecha ."\n";
    }
    //consultas

    //modificar
    public static function modificarVenta($_id_autoincremental , $mail, $tipo, $cantidad ,$aVenta){

        //PARTE NO GENERICA
        if(isset($aVenta) && isset($_id_autoincremental) && isset($tipo) && isset($cantidad) && isset($mail)){
        //PARTE NO GENERICA

            //PARTE NO GENERICA
            $Key = Venta::buscarVenta((int)$_id_autoincremental,$aVenta);
            //PARTE NO GENERICA

            if($Key != -1){


                $objEncontrado = $aVenta[$Key];
                //PARTE NO GENERICA
                $objEncontrado->_mail = $mail;
                $objEncontrado ->_tipo = $tipo;
                $objEncontrado ->_cantidad = (int)$cantidad;
                //PARTE NO GENERICA


                echo "La venta se modifico";
                return $aVenta;
            }else{
                echo "La venta no existe";
                return $aVenta;
            }
            
        }else{
            echo "Faltan datos";
        }


    }

    public static function  buscarVenta($_id_autoincremental , $aVenta){
        $existe= -1;
        foreach ($aVenta as $key =>$obj){
            if($obj->_id_autoincremental == $_id_autoincremental){
                return $key;
            }
        }
        return $existe;

    }
    //modificar


    //borrar
    public static function borrarVenta($_id_autoincremental, $aVenta ) {
        $exito = false;

        if (isset($aVenta) && isset($_id_autoincremental)) {

            //PARTE NO GENERICA
            $Key = Venta::buscarVenta($_id_autoincremental, $aVenta);
            //PARTE NO GENERICA
            
            if ($Key != -1) {
                
                $obj = $aVenta[$Key];
                //PARTE NO GENERICA
                $nombre_archivo = $obj->_nombre . " - " . $obj->_tipo . " - " . $obj->_mail. ".jpg";
                //PARTE NO GENERICA

                //rutas
                $dirOld = './ImagenesDeLaVenta/';
                $dirNew = "./BACKUPVENTAS/2024/";
                
                //verifica que crea la carpeta nueva
                is_dir($dirNew) ?: mkdir($dirNew, 0777, true);
                
                //setea las rutas con los nombres
                $ruta_destinoOld = $dirOld . $nombre_archivo ;
                $ruta_destinoNew = $dirNew . $nombre_archivo ;
    
                // Verificar si el archivo existe
                if (!file_exists($ruta_destinoOld)) {
                    echo "El archivo no existe: $ruta_destinoOld <br>";
                    return $aVenta;
                }
    
                // Intentar copiar el archivo
                if (copy($ruta_destinoOld, $ruta_destinoNew)) {
                    //elimina la venta 
                    unset($aVenta[$Key]);
                    //elimina el archivo old 
                    unlink($ruta_destinoOld);
                    //muestra que salio bien 
                    echo "Venta eliminada.<br>";
                    return $aVenta;
                } else {
                    echo "Ocurrió un problema al copiar el archivo.<br>";
                }
            } else {
                echo "La venta no existe.<br>";
            }
        } else {
            echo "Faltan datos.<br>";
        }
        return $exito;
    }

    public static function guardarVenta($arrayVenta)
    {
        if (isset($arrayVenta)) {
            //abre el archiivo

            //PARTE NO GENERICA
            $archivo = fopen("venta.json", "w");
            //PARTE NO GENERICA


            //cadena en la que se escribiran los datos del archivo
            if ($archivo) {
                $ventas = array();

                foreach ($arrayVenta as $venta) {

                    $auxVenta = get_object_vars($venta);

                    array_push($ventas, $auxVenta);
                }
                fputs($archivo, json_encode($ventas));
                fclose($archivo);
            }
        } else {
            echo "<p>¡Algo salió mal!</p>";
        }
    }
    //borrar



}