<?php

require_once './clases/conjunto.php';

class Tienda
{
    public $_nombre;
    public $_precio;
    public $_tipo;
    public $_talla;
    public $_color;
    public $_stock;


    public $_id_autoincremental; // Atributo de instancia para el número de pedido
    public static $_id_autoincremental_counter = 0; // Contador de pedidos


    public function __construct($nombre, $precio, $tipo, $talla, $color, $stock)
    {

        $this->_nombre = $nombre;
        $this->_precio = $precio;
        $this->_tipo = $tipo;
        $this->_talla = $talla;
        $this->_color = $color;
        $this->_stock = $stock;

        self::$_id_autoincremental_counter++;
        $this->_id_autoincremental = self::$_id_autoincremental_counter;
    }

    public static function cantidad_id()
    {
        return self::$_id_autoincremental_counter;
    }


    public static function leerJson($ruta)
    {
        if (!file_exists($ruta)) {
            $archivo = fopen($ruta, 'w');
            fclose($archivo);
            $arrayObjs = array();
            return $arrayObjs;
        } else {
            $archivo = fopen($ruta, 'r');

            $contenido = fread($archivo, filesize($ruta));

            $data = json_decode($contenido, true);
            $arrayObjs = array();

            foreach ($data as $objData) {


                if ($objData['_tipo'] != 'Conjunto') {

                    $obj = new Tienda(
                        $objData['_nombre'],
                        $objData['_precio'],
                        $objData['_tipo'],
                        $objData['_talla'],
                        $objData['_color'],
                        $objData['_stock'],
                    );

                } else {
                    $obj = new Conjunto(
                        $objData['_nombre_camisa'],
                        $objData['_nombre_pantalon'],
                        $objData['_talla_camisa'],
                        $objData['_talla_pantalon'],
                        $objData['_precioTotal'],
                        $objData['_tipo'],
                        $objData['_id'],
                    );
                }


                array_push($arrayObjs, $obj);
            }


            fclose($archivo);
            return $arrayObjs;
        }
    }
    public  static  function  buscarIguales($nombre, $tipo, $array_objs)
    {
        $existe =  -1;
        foreach ($array_objs as $key => $obj) {

            if ($obj->_tipo != 'Conjunto') {

                if ($obj->_nombre == $nombre  && $obj->_tipo == $tipo) {
                    $existe = true;
                    return $key;
                }

            }
        }
        return $existe;
    }

    public static function agregarObjets($nombre, $precio, $tipo, $talla, $color, $stock, $arrayObjs)
    {
        $existe = false;
        if (!empty($arrayObjs)) {


            $objsKey = Tienda::buscarIguales($nombre, $tipo, $arrayObjs);

            if ($objsKey != -1) {

                $objsEncontrado = $arrayObjs[$objsKey];

                if (isset($objsEncontrado) && isset($precio)) {

                    $objsEncontrado->_precio = $precio + $objsEncontrado->_precio;
                    $objsEncontrado->_stock = $stock + $objsEncontrado->_stock;
                    $existe = true;
                    echo "Agregar: Se modifico el precio y el stock porque ya existe ";
                } else {
                    echo "Algo salio mal";
                }
            }
        }

        if (!$existe) {




            $obj = new Tienda($nombre, $precio, $tipo, $talla, $color, $stock);
            array_push($arrayObjs, $obj);
            echo "Agregar: Se agrego ";
        }
        return $arrayObjs;
    }

    public static function crearImagen($carpeta_archivos, $array_objs, $archivoTemp, $nombreArchivo)
    {

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        if (isset($array_objs)) {

            $total = count($array_objs);

            for ($i = $total - 1; $i >= 0; $i--) {

                $obj = $array_objs[$i];

                $nombre_archivo = $obj->_nombre . " - " . $obj->_tipo . ".";


                $ruta_destino = $carpeta_archivos . $nombre_archivo . $extension;

                if (move_uploaded_file($archivoTemp, $ruta_destino)) {
                    echo "\n" . 'Imagen : El archivo ha sido cargado correctamente: ' . $nombre_archivo;
                    break;
                }
            }
        } else {
            echo "\n" . "No se puede guardar la imagen debido a que no existe ";
        }
    }

    public static function guardarJSON($array_objs, $nombre_archivo)
    {
        $exito = false;
        $archivo = fopen($nombre_archivo, "w");
        if ($archivo) {
            $aObjs = array();
            foreach ($array_objs as $obj) {
                $auxObj = get_object_vars($obj);
                array_push($aObjs, $auxObj);
            }
            fputs($archivo, json_encode($aObjs));
            fclose($archivo);
            $exito = true;
        }
        if (!$exito) {
            echo "<p>¡Algo salió mal!</p>";
        }
    }

    public static function consultaIguales($nombre, $tipo, $color, $array_objs)
    {

        if (isset($array_objs)) {

            $Key = Tienda::buscarIgColor($nombre, $tipo, $color, $array_objs);


            if ($Key != -1) {
                return "existe";
            } else {
                return "no existe";
            }
        } else {
            echo "No se leyo bien el JSON";
        }
    }

    public  static  function  buscarPorNombre($nombre, $array_objs)
    {
        $existe =  -1;
        foreach ($array_objs as $key => $obj) {

            if ($obj->_tipo != 'Conjunto') {

                if ($obj->_nombre == $nombre) {
                    $existe = true;
                    return $key;
                }

            }
        }
        return $existe;
    }


    public  static  function  buscarIgColor($nombre, $tipo, $color, $array_objs)
    {
        $existe =  -1;
        foreach ($array_objs as $key => $obj) {

            if ($obj->_tipo != 'Conjunto') {

                if ($obj->_nombre == $nombre  && $obj->_tipo == $tipo && $obj->_color == $color) {
                    $existe = true;
                    return $key;
                }

            }
        }
        return $existe;
    }


    //consulta
    public static function buscarEntrePrecios($precioHasta, $precioDesde, $arrayObjs)
    {
        $existe = -1;
        foreach ($arrayObjs as $key => $obj) {
            if ($obj->_precio >= $precioDesde && $obj->_precio <= $precioHasta) {
                return $key;
            }
        }
        return $existe;
    }

    public static function consultaEntrePrecios($precioHasta, $precioDesde, $arrayObjs)
    {
        $objEncontradaKey = Tienda::buscarEntrePrecios($precioHasta, $precioDesde, $arrayObjs);


        if ($objEncontradaKey != -1) {

            $ObjEncontrado = $arrayObjs[$objEncontradaKey];
            Tienda::MostrarDatos($ObjEncontrado);
        } else {
            echo "\n No se encontraron prendas desde " . $precioDesde . " hasta " . $precioHasta;
        }
    }

    public static function MostrarDatos($obj)
    {
        echo "\n Datos del venta:"
            . "\nNumero tienda " . $obj->_id_autoincremental
            . "\nNombre " . $obj->_nombre
            . "\nTipo " . $obj->_tipo . "\n";
    }


    public static function buscarUltimoIdTienda($arrayObjs)
    {

        $ultimoId = 0;

        foreach ($arrayObjs as $obj) {

            if ($obj->_tipo != 'Conjunto') {

                if ($obj->_id_autoincremental > $ultimoId) {

                    $ultimoId = $obj->_id_autoincremental;
                }
            }
        }
        return $ultimoId;
    }



}
