<?php

require_once './clases/pizza.php';

class Venta {

    public $_sabor;
    public $_tipo;
    public $_cantidad;
    public $_mail;
    public $_fecha;

    //Generico
    public $_id_autoincremental; // Atributo de instancia para el número de pedido
    public static $_id_autoincremental_counter = 0; // Contador de pedidos

    public function __construct($sabor ,$tipo,$cantidad, $mail ,$fecha){

        $this->_sabor=$sabor;
        $this->_tipo=$tipo;
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


//SEGUNDA PARTE

    //No es generica
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
                    $objData['_sabor'],
                    $objData['_tipo'],
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

    //No es generica(tres partes no genericas)
    //aPrincipal es para leer el primer json que cree 
    //el aSecundario es de el 2do json (ej ventas)
    public static function altaObjs($sabor, $tipo ,$cantidad,$mail,$aPrincipal,$aSecundario , $nombreJson){

        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
        $Key = Pizza::buscarIguales($sabor, $tipo,$aPrincipal);
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
                Pizza::guardarJSON($aPrincipal,$nombreJson);
                //PARTE NO GENERICA(se debe cambiar por la funcion indicando el objeto correcto)


                $hoy = new DateTime();
                $fechahoy = $hoy -> format('y-m-d');

                //PARTE NO GENERICA
                $obj = new Venta($obj_buscado->_sabor , $obj_buscado->_tipo  ,$cuenta,$mail, $fechahoy);
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

    //no es generica
    public static function crearImagen($carpeta_archivos, $array_objs, $archivoTemp, $nombreArchivo) {

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        if(isset($array_objs)){

            $total = count($array_objs);

            for ($i = $total - 1; $i >= 0; $i--) {
               
                $obj = $array_objs[$i];

                //PARTE NO GENERICA
                $nombre_archivo = $obj->_sabor . " - " . $obj->_tipo . " - " . $obj->_mail. ".";
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

//SEGUNDA PARTE



//TERCERA PARTE
//-------------------------------------------------------------------------------
//
//a- la cantidad de pizzas vendidas
//
//
//Sin parametros (Generica)
public static function buscarCantidad($arrayObjs){
    $cont= 0;
    foreach($arrayObjs as $obj){
        $cont++;
    }
    return $cont;
}
//No es generica
public static function consultaCantidad($arrayObjs){
    //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
    $ContVentas= Venta::buscarCantidad($arrayObjs);     
    //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
    if($ContVentas >= 0){
        echo "\n Cantidad Vendida es ". $ContVentas."\n";
    }else{
        echo "No se vendio nada";
    }
} 

//-------------------------------------------------------------------------------
//
//b- el listado de ventas entre dos fechas ordenado por sabor.
//
//
//Generica
public static function buscarEntreFechas($fechaHasta , $fechaDesde ,$arrayObjs ){
    $existe= -1;
    foreach($arrayObjs as $key=>$obj){
        if($obj ->_fecha >= $fechaDesde && $obj ->_fecha <= $fechaHasta){
            return $key;
        }
    }
    return $existe;
}
//No es generica
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
//-------------------------------------------------------------------------------
//
//c- el listado de ventas de un usuario ingresado.
//
//
//Generica(no tanto porque solo hay que cambiar el _mail)
public static function buscarMail($usuario ,$arrayObjs){
    $existe= -1;
    foreach($arrayObjs as $key=>$obj){
        if($obj ->_mail == $usuario){
            return $key;
        }
    }
    return $existe;
}
//No es generica
public static function consultaUsuario($usuario ,$arrayObjs ){
//PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
    $objEncontradaKey = Venta::buscarMail($usuario ,$arrayObjs);
//PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
    if($objEncontradaKey != -1){

        $ObjEncontrado = $arrayObjs[$objEncontradaKey];
        Venta::MostrarDatos($ObjEncontrado);
    }else{
        echo "No se encontraron datos sobre ventas del usuario " . $usuario;
    }
}
//-------------------------------------------------------------------------------
//
//d- el listado de ventas de un sabor ingresado
//
//
//Generica(no tanto porque solo hay que cambiar el _sabor)
public static function buscarSabor($sabor,$arrayObjs ){
    $existe= -1;
    foreach($arrayObjs as $key=>$obj){
        if($obj ->_sabor >= $sabor){
            return $key;
        }
    }
    return $existe;
}
//No es generica
public static function consultaPorSabores ($sabor,$arrayObjs){
//PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
    $objEncontradaKey = Venta::buscarSabor($sabor,$arrayObjs);
//PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
    if($objEncontradaKey != -1){

        $ObjEncontrado = $arrayObjs[$objEncontradaKey];
        Venta::MostrarDatos($ObjEncontrado);
    }else{
        echo "\n No se encontraron con el sabor " . $sabor;
    }
}
//Funcion Mostrar no generica(se cambia como quiero que se vea el mensaje)
public static function MostrarDatos($obj){
        echo "\n Datos del venta:"
        ."\nNumero Pedido ". $obj ->_id_autoincremental
        ."\nSabor ". $obj ->_sabor
        ."\nTipo ". $obj ->_tipo
        ."\nFecha ". $obj ->_fecha ."\n";
}

//-------------------------------------------------------------------------------
//TERCERA PARTE 
}
