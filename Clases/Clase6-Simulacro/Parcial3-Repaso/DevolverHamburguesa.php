<?php

require_once './Clases/venta.php';
require_once './Clases/Devolucion.php';
require_once './Clases/Cupones.php';

$numero_pedido = $_POST['numP'];
$causaDevolcion = $_POST['devolucion'];

$nombre_archivo = $_FILES ['archivo']['name'];
$archivoTemp = $_FILES['archivo']['tmp_name'];
$carpeta_archivos = './ImagenesDevolucion/';

$aVenta = Venta::leerJson("Venta.json");

$aDevolucion =Devolucion::DevolverHelado($aVenta,$numero_pedido,$causaDevolcion);

Devolucion::guardarDevolucion($aDevolucion);

Devolucion::crearImagen($carpeta_archivos,$aDevolucion,$archivoTemp,$nombre_archivo);

$aCupon =Cupones::crearCupon($aVenta,$numero_pedido);

Cupones::guardarCupon($aCupon);
