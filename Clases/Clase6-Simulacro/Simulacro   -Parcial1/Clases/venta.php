<?php

require_once './Clases/Heladeria.php';


class Venta {

    public $_sabor;
    public $_tipo;
    public $_stock;
    public $_mail;
    public $_fecha;

    public $_numero_pedido; // Atributo de instancia para el número de pedido
    public static $_numero_pedido_counter = 0; // Contador de pedidos

    public function __construct($sabor ,$tipo,$stock, $mail ,$fecha){

        $this->_sabor=$sabor;
        $this->_tipo=$tipo;
        $this->_stock=$stock;
        $this->_mail = $mail;
        $this->_fecha = $fecha;


        self::$_numero_pedido_counter++;
        $this->_numero_pedido = self::$_numero_pedido_counter;
    }

    public static function cantidadUsuarios() {
        return self::$_numero_pedido_counter;
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
                $venta = new Venta(
                    $heladeriaData['_sabor'],
                    $heladeriaData['_tipo'],
                    $heladeriaData['_stock'],
                    $heladeriaData['_mail'],
                    $heladeriaData['_fecha']
                    
                );
                
                // Agregar la instancia de Heladeria al array
                array_push($arrayHeladerias, $venta);
            }
        
            // Cierra el archivo
            fclose($archivo);
        
            // Retornar el array de Heladerias
            return $arrayHeladerias;
        }

    }
    public static function altaVenta($sabor, $tipo ,$stock,$mail,$arrayHelados,$aVenta){

        $HeladoKey = Heladeria::buscarHeladerasIguales($sabor, $tipo,$arrayHelados);
        $HeladoBuscado = $arrayHelados[$HeladoKey];


        $exito = false;

        if (isset($HeladoBuscado) && isset($HeladoBuscado->_stock) && isset($aVenta)) {
            $cuenta = $HeladoBuscado->_stock - $stock;

            if ($cuenta >= 0) { // Verificar que no se vendan más de lo que se tiene

                $HeladoBuscado->_stock = $cuenta;

                Heladeria::guardarHeladeria($arrayHelados);

                $hoy = new DateTime();
                $fechahoy = $hoy -> format('y-m-d');

                $venta = new Venta($HeladoBuscado->_sabor , $HeladoBuscado->_tipo  ,$cuenta,$mail, $fechahoy);
                array_push($aVenta, $venta);
                
                echo "Agregar: Se agrego la venta";
                return $aVenta;
            }else{
                echo "no podes vender mas de lo que tenes";
                return $exito;
            }
        }else{
            echo " No se puede hacer una venta a una heladeria que no existe";
        }
    }
    public static function guardarVenta($arrayVenta)
    {
        if (isset($arrayVenta)) {
            //abre el archiivo
            $archivo = fopen("venta.json", "w");
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
    public static function crearImagen($carpeta_archivos, $arrayVenta, $archivoHeladoTemp, $nombreArchivo) {

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        if(isset($arrayVenta)){

            $totalHelados = count($arrayVenta);

            for ($i = $totalHelados - 1; $i >= 0; $i--) {


                $obj = $arrayVenta[$i];
                $nombre_archivo =  $obj->_sabor . " - " .  $obj->_tipo . "-" . $obj->_fecha . "-" . $obj->_mail . ".";
    
    
                $ruta_destino = $carpeta_archivos . $nombre_archivo . $extension;
        
                if (move_uploaded_file($archivoHeladoTemp, $ruta_destino)) {
                    echo "\n".'Imagen : El archivo ha sido cargado correctamente: ' . $nombre_archivo;
                    break;
                }
            }
        }else{
            echo "\n"."No se puede guardar la imagen de la venta a una heladeria que no existe ";
        }

        
    }




    //otras partes
    public static function modificarVenta($numero_pedido , $mail, $sabor, $stock ,$arrayVenta){

        if(isset($arrayVenta) && isset($numero_pedido) && isset($sabor) && isset($stock) && isset($mail)){

            $ventaKey = Venta::buscarVenta((int)$numero_pedido,$arrayVenta);

            if($ventaKey != -1){
                $ventaEncontrada = $arrayVenta[$ventaKey];
                $ventaEncontrada->_mail = $mail;
                $ventaEncontrada ->_sabor = $sabor;
                $ventaEncontrada ->_stock = (int)$stock;
                echo "La venta se modifico";
                return $arrayVenta;
            }else{
                echo "La venta no existe";
                return $arrayVenta;
            }
            
        }else{
            echo "Faltan datos";
        }


    }
    public static function  buscarVenta($numero_pedido , $arrayVenta){
        $existe= -1;
        foreach ($arrayVenta as $key =>$venta){
            if($venta->_numero_pedido == $numero_pedido){
                return $key;
            }
        }
        return $existe;

    }
    public static function borrarVenta($numero_pedido, $arrayVenta) {
        $exito = false;
        if (isset($arrayVenta) && isset($numero_pedido)) {
            $ventaEncontradaKey = Venta::buscarVenta($numero_pedido, $arrayVenta);
            if ($ventaEncontradaKey != -1) {
                $venta = $arrayVenta[$ventaEncontradaKey];
                $nombre_archivo = $venta->_sabor . " - " . $venta->_tipo . "-" . $venta->_fecha . "-" . $venta->_mail . ".jpg";
                $dirOld = './ImagenesDeLaVenta/2024/';
                $dirNew = "./BACKUPVENTAS/2024/";
                is_dir($dirNew) ?: mkdir($dirNew, 0777, true);
                $ruta_destinoOld = $dirOld . $nombre_archivo ;
                $ruta_destinoNew = $dirNew . $nombre_archivo;
    
                // Verificar si el archivo existe
                if (!file_exists($ruta_destinoOld)) {
                    echo "El archivo no existe: $ruta_destinoOld<br>";
                    return $arrayVenta;
                }
    
                // Intentar copiar el archivo
                if (copy($ruta_destinoOld, $ruta_destinoNew)) {
                    unset($arrayVenta[$ventaEncontradaKey]);
                    unlink($ruta_destinoOld);
                    echo "Venta eliminada.<br>";
                    return $arrayVenta;
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




    //metodos consultas
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
            echo "\n Cantidad de Helados Vendidos en ". $fecha_recibida->format('y-m-d')
            ."\n Helados Vendidos : ". $ContVentas."\n";
        }else{
            echo "No se vendio nada";
        }
    } 

    public static function buscarUsuario($usuario ,$arrayObjs){
        $existe= -1;
        foreach($arrayObjs as $key=>$obj){
            if($obj ->_mail == $usuario){
                return $key;
            }
        }
        return $existe;
    }

    public static function consultaUsuario($usuario ,$arrayObjs ){

        $VentaEncontradaKey = Venta::buscarUsuario($usuario ,$arrayObjs);

        if($VentaEncontradaKey != -1){

            $VentaEncontrada = $arrayObjs[$VentaEncontradaKey];
            Venta::MostrarDatos($VentaEncontrada);
        }else{
            echo "No se encontraron datos sobre ventas del usuario " . $usuario;
        }
    }

    public static function consultaEntreFechas($fechaHasta , $fechaDesde ,$arrayObjs ){
        $VentaEncontradaKey = Venta::buscarEntreFechas($fechaHasta , $fechaDesde ,$arrayObjs);

        if($VentaEncontradaKey != -1){

            $VentaEncontrada = $arrayObjs[$VentaEncontradaKey];
            Venta::MostrarDatos($VentaEncontrada);
        }else{
            echo "\n No se encontraron ventas desde " . $fechaDesde ." hasta " . $fechaHasta;
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

    public static function consultaPorSabores ($sabor,$arrayObjs){

        $VentaEncontradaKey = Venta::buscarSabor($sabor,$arrayObjs);

        if($VentaEncontradaKey != -1){

            $VentaEncontrada = $arrayObjs[$VentaEncontradaKey];
            Venta::MostrarDatos($VentaEncontrada);
        }else{
            echo "\n No se encontraron con el sabor " . $sabor;
        }
    }

    public static function buscarSabor($sabor,$arrayObjs ){
        $existe= -1;
        foreach($arrayObjs as $key=>$obj){
            if($obj ->_sabor >= $sabor){
                return $key;
            }
        }
        return $existe;
    }

    

/*Funciones pasa consultar vaso (no las uso porque no tengo la variable en mi contructor de venta)**

    public static function buscarVaso($vaso,$arrayObjs ){
        $existe= -1;
        foreach($arrayObjs as $key=>$obj){
            if($obj ->_vaso >= $vaso){
                return $key;
            }
        }
        return $existe;
    }

    public static function consultaPorVaso ($vaso,$arrayObjs){

        $VentaEncontradaKey = Venta::buscarVaso($vaso,$arrayObjs);

        if($VentaEncontradaKey != -1){
            $VentaEncontrada = $arrayObjs[$VentaEncontradaKey];
            Venta::MostrarDatos($VentaEncontrada);
        }else{
            echo "\n No se encontraron con el vaso " . $vaso;
        }
    }

*/

    public static function MostrarDatos($obj)
    {
        echo "\n Datos del venta:"
        ."\nNumero Pedido ". $obj ->_numero_pedido
        ."\nSabor ". $obj ->_sabor
        ."\nTipo ". $obj ->_tipo
        ."\nFecha ". $obj ->_fecha ."\n";
    }



}

