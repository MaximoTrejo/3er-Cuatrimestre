<?php

require_once './clases/tienda.php';
require_once './clases/venta.php';

class VentaConjunto {

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

    
    public static function altaConjunto($nombreCamisa,$nombrePantalon,$tipoCamisa,$tipoPantalon,$aPrincipal,$aSecundario){

        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)
        $KeyCamisaEncntrada = Tienda::buscarIguales($nombreCamisa, $tipoCamisa,$aPrincipal);

        $KeyPantalonEncontrado = Tienda::buscarIguales($nombrePantalon, $tipoPantalon,$aPrincipal);
        //PARTE NO GENERICA(cambiar funcion llamando al objeto correcto)

        if ($KeyCamisaEncntrada != -1 && $KeyPantalonEncontrado != -1 && isset($aSecundario)) {

            $obj_camisa_buscado = $aPrincipal[$KeyCamisaEncntrada];
            $obj_pantalon_buscado = $aPrincipal[$KeyPantalonEncontrado];

                $ultimoID = Venta::buscarUltimoIdVenta($aSecundario);

                if($ultimoID >= 0 ){

                    $sumaTotal = $obj_camisa_buscado->_precio + $obj_pantalon_buscado->_precio ; 
                    $IdConunto = $ultimoID + 1;
                    $obj = new VentaConjunto($nombreCamisa , $nombrePantalon ,$obj_camisa_buscado->_talla ,$obj_pantalon_buscado->_talla , $sumaTotal , 'Conjunto',$IdConunto );
                }

                array_push($aSecundario, $obj);
                
                echo "Agregar: Se agrego correctamente";
                return $aSecundario;
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
                $nombre_archivo = $obj->_nombre_camisa . " - " . $obj->_nombre_pantalon ."." ;
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



}