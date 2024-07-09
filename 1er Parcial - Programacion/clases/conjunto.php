<?php

require_once './clases/tienda.php';
require_once './clases/venta.php';

class Conjunto {

    public $_nombre_camisa;
    public $_nombre_pantalon;
    public $_talla_camisa;
    public $_talla_pantalon;
    public $_precioTotal;
    public $_tipo;
    public $_id;

    public function __construct($nombre_camisa, $nombre_pantalon, $talla_camisa, $talla_pantalon,$precioTotal,$tipo,$id){
        $this->_nombre_camisa = $nombre_camisa;
        $this->_nombre_pantalon = $nombre_pantalon;
        $this->_talla_camisa = $talla_camisa;
        $this->_talla_pantalon = $talla_pantalon; 
        $this ->_precioTotal = $precioTotal;
        $this->_tipo = $tipo;
        $this->_id= $id;
    }

    
    public static function altaConjuntoTienda($nombreCamisa,$nombrePantalon,$tipoCamisa,$tipoPantalon,$aTienda){

        $KeyCamisaEncntrada = Tienda::buscarIguales($nombreCamisa, $tipoCamisa,$aTienda);

        $KeyPantalonEncontrado = Tienda::buscarIguales($nombrePantalon, $tipoPantalon,$aTienda);


        if ($KeyCamisaEncntrada != -1 && $KeyPantalonEncontrado != -1) {

            $obj_camisa_buscado = $aTienda[$KeyCamisaEncntrada];
            $obj_pantalon_buscado = $aTienda[$KeyPantalonEncontrado];

                $ultimoID = Tienda::buscarUltimoIdTienda($aTienda);

                if($ultimoID >= 0 ){

                    $sumaTotal = $obj_camisa_buscado->_precio + $obj_pantalon_buscado->_precio ; 
                    $IdConunto = $ultimoID + 1;
                    $obj = new conjunto($nombreCamisa , $nombrePantalon ,$obj_camisa_buscado->_talla ,$obj_pantalon_buscado->_talla , $sumaTotal , 'Conjunto',$IdConunto);
                }

                array_push($aTienda, $obj);
                
                echo "Agregar: Se agrego correctamente";
                return $aTienda;
        }else{
            echo " No se puede hacer una venta a una heladeria que no existe";
        }
    }


    //2daParte
    public static function altaConjuntoVenta($nombreCamisa,$nombrePantalon,$tipoCamisa,$tipoPantalon,$stockCamisa,$stockPantalon,$aPrincipal,$aSecundario,$nombreJson){


        $KeyCamisaEncntrada = Tienda::buscarIguales($nombreCamisa, $tipoCamisa,$aPrincipal);

        $KeyPantalonEncontrado = Tienda::buscarIguales($nombrePantalon, $tipoPantalon,$aPrincipal);


        $exito = false;

        if ($KeyCamisaEncntrada != -1 && $KeyPantalonEncontrado != -1 && isset($aSecundario)) {

            $obj_camisa_buscado = $aPrincipal[$KeyCamisaEncntrada];
            $obj_pantalon_buscado = $aPrincipal[$KeyPantalonEncontrado];

            $cuentaCamisa = $obj_camisa_buscado->_stock - $stockCamisa;
            $cuentaPantalon = $obj_pantalon_buscado->_stock - $stockPantalon;


            if ($cuentaCamisa >= 1  && $cuentaPantalon >= 1 ) { 

                $obj_camisa_buscado->_stock = $cuentaCamisa;
                $obj_pantalon_buscado->_stock = $cuentaPantalon;

                Tienda::guardarJSON($aPrincipal,$nombreJson);

                $ultimoID = Venta::buscarUltimoIdVentaConjunto($aSecundario);

                if($ultimoID >= 0 ){

                    $sumaTotal = $obj_camisa_buscado->_precio + $obj_pantalon_buscado->_precio  ; 
                    $totalConDescuento = $sumaTotal -(15 * $sumaTotal / 100);
                    $IdConunto = $ultimoID + 1;
                    $obj = new conjunto($nombreCamisa , $nombrePantalon ,$obj_camisa_buscado->_talla ,$obj_pantalon_buscado->_talla , $totalConDescuento , 'Conjunto',$IdConunto );
                }

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

                $nombre_archivo = $obj->_nombre_camisa . " - " . $obj->_nombre_pantalon ."." ;

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



}