<?php

require_once './clases/tienda.php';
require_once './clases/conjunto.php';

class Venta
{


    public $_nombre;
    public $_tipo;
    public $_talla;
    public $_stock;
    public $_mail;
    public $_fecha;

    public $_id_autoincremental; // Atributo de instancia para el número de pedido
    public static $_id_autoincremental_counter = 0; // Contador de pedidos


    public function __construct($nombre, $tipo, $talla, $stock, $mail, $fecha)
    {

        $this->_nombre = $nombre;
        $this->_tipo = $tipo;
        $this->_talla = $talla;
        $this->_stock = $stock;
        $this->_mail = $mail;
        $this->_fecha = $fecha;



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


                    $obj = new Venta(
                        $objData['_nombre'],
                        $objData['_tipo'],
                        $objData['_talla'],
                        $objData['_stock'],
                        $objData['_mail'],
                        $objData['_fecha'],
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

    public static function altaObjs($nombre, $tipo, $stock, $mail, $aPrincipal, $aSecundario, $nombreJson)
    {


        $Key = Tienda::buscarIguales($nombre, $tipo, $aPrincipal);


        $exito = false;

        if ($Key != -1 && isset($aSecundario)) {

            $obj_buscado = $aPrincipal[$Key];


            $cuenta = $obj_buscado->_stock - $stock;

            if ($cuenta >= 0) {

                $obj_buscado->_stock = $cuenta;


                Tienda::guardarJSON($aPrincipal, $nombreJson);



                $hoy = new DateTime();
                $fechahoy = $hoy->format('y-m-d');


                $obj = new Venta($obj_buscado->_nombre, $obj_buscado->_tipo, $obj_buscado->_talla, $cuenta, $mail, $fechahoy);



                array_push($aSecundario, $obj);

                echo "Agregar: Se agrego correctamente";
                return $aSecundario;
            } else {
                echo "No podes vender mas de lo que tenes";
                return $exito;
            }
        } else {
            echo " No se puede hacer una venta a una heladeria que no existe";
        }
    }

    public static function crearImagen($carpeta_archivos, $array_objs, $archivoTemp, $nombreArchivo)
    {

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        if (isset($array_objs)) {

            $total = count($array_objs);

            for ($i = $total - 1; $i >= 0; $i--) {

                $obj = $array_objs[$i];


                $nombre_archivo = $obj->_nombre . " - " . $obj->_tipo . " - " . $obj->_talla . "." . $obj->_mail . ".";


                $ruta_destino = $carpeta_archivos . $nombre_archivo . $extension;


                if (move_uploaded_file($archivoTemp, $ruta_destino)) {
                    echo "\n" . 'Imagen : El archivo ha sido cargado correctamente: ' . $nombre_archivo;
                    break;
                } else {
                    echo "No se cargo correctamente el archivo ";
                }
            }
        } else {
            echo "\n" . "No se puede guardar la imagen ";
        }
    }


    //consultas

    public static function buscarCantidadFecha($fecha_recibida, $arrayObjs)
    {
        $cont = 0;

        foreach ($arrayObjs as $obj) {

            if ($obj->_tipo != "Conjunto") {
                if ($obj->_fecha == $fecha_recibida->format('y-m-d')) {
                    $cont++;
                }
            }
        }
        return $cont;
    }

    public static function consultaFecha($fecha_recibida, $arrayObjs)
    {

        $ContVentas = Venta::buscarCantidadFecha($fecha_recibida, $arrayObjs);

        if ($ContVentas >= 0) {
            echo "\n Cantidad  Vendida en " . $fecha_recibida->format('y-m-d')
                . "\n Vendido : " . $ContVentas . "\n";
        } else {
            echo "No se vendio nada";
        }
    }

    public static function buscarUsuario($usuario, $arrayObjs)
    {
        $existe = -1;
        foreach ($arrayObjs as $key => $obj) {
            if ($obj->_mail == $usuario) {
                return $key;
            }
        }
        return $existe;
    }

    public static function buscarConjuntos($arrayObjs)
    {
        $conjuntos = [];
        //$existe = -1;
        foreach ($arrayObjs as $key => $obj) {

            if ($obj->_tipo == "Conjunto") {

                $conjuntos[] = $key;
            }
        }
        return $conjuntos;
    }


    public static function consultaUsuario($usuario, $arrayObjs)
    {

        $VentaEncontradaKey = Venta::buscarUsuario($usuario, $arrayObjs);

        if ($VentaEncontradaKey != -1) {

            $VentaEncontrada = $arrayObjs[$VentaEncontradaKey];
            Venta::MostrarDatos($VentaEncontrada);
        } else {
            echo "No se encontraron datos sobre ventas del usuario " . $usuario;
        }
    }

    public static function buscarTipo($Tipo, $arrayObjs)
    {
        $existe = -1;
        foreach ($arrayObjs as $key => $obj) {
            if ($obj->_tipo >= $Tipo) {
                return $key;
            }
        }
        return $existe;
    }

    public static function consultaPorTipo($Tipo, $arrayObjs)
    {
        $objEncontradaKey = Venta::buscarTipo($Tipo, $arrayObjs);

        if ($objEncontradaKey != -1) {

            $ObjEncontrado = $arrayObjs[$objEncontradaKey];
            Venta::MostrarDatos($ObjEncontrado);
        } else {
            echo "\n No se encontraron con el sabor " . $Tipo;
        }
    }
    public static function MostrarDatos($obj)
    {
        echo "\n Datos del venta:"
            . "\nNumero Pedido " . $obj->_id_autoincremental
            . "\nNombre " . $obj->_nombre
            . "\nTipo " . $obj->_tipo
            . "\nFecha " . $obj->_fecha . "\n";
    }

    public static function MostrarDatosConjunto($obj)
    {
        echo "\n Datos del venta:"
            . "\nNumero Pedido " . $obj->_id
            . "\nNombreCamisa " . $obj->_nombre_camisa
            . "\nNombrePantalon " . $obj->_nombre_pantalon
            . "\nTallaCamisa " . $obj->_talla_camisa
            . "\nTallaPantalon " . $obj->_talla_pantalon
            . "\nTipo " . $obj->_tipo
            . "\nPrecioTotal " . $obj->_precioTotal . "\n";
    }




    //modificar
    public static function modificarVenta($_id_autoincremental, $mail, $nombre, $talla, $tipo, $stock, $aVenta)
    {


        if (isset($aVenta) && isset($_id_autoincremental) && isset($tipo) && isset($stock) && isset($mail)) {



            $Key = Venta::buscarVenta((int)$_id_autoincremental, $aVenta);


            if ($Key != -1) {
                $objEncontrado = $aVenta[$Key];

                $objEncontrado->_mail = $mail;
                $objEncontrado->_nombre = $nombre;
                $objEncontrado->_talla = $talla;
                $objEncontrado->_tipo = $tipo;
                $objEncontrado->_stock = (int)$stock;



                echo "La venta se modifico";
                return $aVenta;
            } else {
                echo "La venta no existe";
                return $aVenta;
            }
        } else {
            echo "Faltan datos";
        }
    }

    public static function  buscarVenta($_id_autoincremental, $aVenta)
    {
        $existe = -1;
        foreach ($aVenta as $key => $obj) {
            if ($obj->_id_autoincremental == $_id_autoincremental) {
                return $key;
            }
        }
        return $existe;
    }


    //borrar

    public static function borrarVenta($_id_autoincremental, $aVenta)
    {
        $exito = false;

        if (isset($aVenta) && isset($_id_autoincremental)) {

            $Key = Venta::buscarVenta($_id_autoincremental, $aVenta);


            if ($Key != -1) {

                $obj = $aVenta[$Key];

                $nombre_archivo = $obj->_nombre . " - " . $obj->_tipo . " - " . $obj->_talla . "." . $obj->_mail . ".jpg";

                //rutas
                $dirOld = './ImagenesDeVenta/2024/';
                $dirNew = "./BACKUPVENTAS/2024/";

                is_dir($dirNew) ?: mkdir($dirNew, 0777, true);

                $ruta_destinoOld = $dirOld . $nombre_archivo;
                $ruta_destinoNew = $dirNew . $nombre_archivo;

                if (!file_exists($ruta_destinoOld)) {
                    echo "El archivo no existe: $ruta_destinoOld <br>";
                    return $aVenta;
                }

                if (copy($ruta_destinoOld, $ruta_destinoNew)) {

                    unset($aVenta[$Key]);

                    unlink($ruta_destinoOld);
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

            $archivo = fopen("venta.json", "w");


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



    public static function buscarUltimoIdVenta($arrayObjs)
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


    public static function buscarUltimoIdVentaConjunto($arrayObjs)
    {

        $ultimoId = 0;

        foreach ($arrayObjs as $obj) {

            if ($obj->_tipo == 'Conjunto') {

                if ($obj->_id > $ultimoId) {

                    $ultimoId = $obj->_id;
                }
            }
        }
        return $ultimoId;
    }


    public static function productoMasVendido($arrayVentas)
    {
        $conteoProductos = [];

        foreach ($arrayVentas as $venta) {

            if ($venta->_tipo != "Conjunto") {

                $nombreProducto = $venta->_nombre;

                if (isset($conteoProductos[$nombreProducto])) {

                    $conteoProductos[$nombreProducto] += $venta->_stock;
                } else {
                    $conteoProductos[$nombreProducto] = $venta->_stock;
                }
            }
        }
        $productoMasVendido = null;
        $maxVentas = 0;
        foreach ($conteoProductos as $nombreProducto => $cantidadVentas) {
            if ($cantidadVentas > $maxVentas) {
                $maxVentas = $cantidadVentas;
                $productoMasVendido = $nombreProducto;
            }
        }
        echo $productoMasVendido;
    }


    //2daParte

    public static function consultaTodosConjunto($arrayObjs)
    {
        $VentaEncontradaKey = Venta::buscarConjuntos($arrayObjs);

        if (!empty($VentaEncontradaKey)) {

            foreach ($VentaEncontradaKey as $conjuntoKey) {

                $VentaEncontrada = $arrayObjs[$conjuntoKey];
                Venta::MostrarDatosConjunto($VentaEncontrada);
            }
        } else {
            echo "No se encontraron conjuntos";
        }
    }

    public static function consultaConjuntoContieneStock($arrayObjsTienda, $arrayObjsVenta)
    {
        $VentaEncontradaKey = Venta::buscarConjuntos($arrayObjsVenta);

        if (!empty($VentaEncontradaKey)) {

            foreach ($VentaEncontradaKey as $conjuntoKey) {

                $VentaEncontrada = $arrayObjsVenta[$conjuntoKey];
                $ArtCamisa = Tienda::buscarPorNombre($VentaEncontrada->_nombre_camisa, $arrayObjsTienda);
                $artPantalon = Tienda::buscarPorNombre($VentaEncontrada->_nombre_pantalon, $arrayObjsTienda);

                if ($ArtCamisa != -1 && $artPantalon != -1) {

                    $artStockCamisa = $arrayObjsTienda[$ArtCamisa];
                    $artStockPantalon = $arrayObjsTienda[$artPantalon];

                    if ($artStockCamisa->_stock >= 1 && $artStockPantalon->_stock >= 1) {
                        Venta::MostrarDatosConjunto($VentaEncontrada);
                    }
                }
            }
        } else {
            echo "No se encontraron conjuntos ";
        }
    }

    public static function consultaPrendaVenta($arrayObjs, $nombrePrenda)
    {
        $VentaEncontradaKey = Venta::buscarConjuntos($arrayObjs);

        if (!empty($VentaEncontradaKey)) {

            foreach ($VentaEncontradaKey as $conjuntoKey) {

                $VentaEncontrada = $arrayObjs[$conjuntoKey];

                if ($VentaEncontrada->_nombre_camisa == $nombrePrenda || $VentaEncontrada->_nombre_pantalon == $nombrePrenda) {

                    $VentaEncontrada = $arrayObjs[$conjuntoKey];
                    Venta::MostrarDatosConjunto($VentaEncontrada);
                }
            }
        } else {
            echo "No se encontraron conjuntos ";
        }
    }
}
