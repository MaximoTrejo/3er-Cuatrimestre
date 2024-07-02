<?php


require_once './Clases/venta.php';

$fechaRecibida = DateTime::createFromFormat('y-m-d', $_POST['fechaParticular']) ? new DateTime($_POST['fechaParticular']) : new DateTime('yesterday');;
$tipo = $_POST['tipo'];
$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'];
$aderezo = $_POST['aderezo'];


$aVenta = Venta::leerJson("Venta.json");

Venta::consultaFecha($fechaRecibida , $aVenta);
Venta::consultaEntreFechas($fechaHasta,$fechaDesde,$aVenta);
Venta::consultaPorTipo($tipo,$aVenta);
Venta::consultaAderezo($aderezo,$aVenta);
