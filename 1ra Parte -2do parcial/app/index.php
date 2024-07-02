<?php

// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

//DB
require_once './db/AccesoDatos.php';
//controllers
require_once './controllers/TiendaControllers.php';
require_once './controllers/VentaControllers.php';
require_once './controllers/UsuariosControllers.php';

//MW
require_once './MW/AuthArticulosTiendaMW.php';
require_once './MW/AuthVenta.php';
require_once './MW/AuthMiddleware.php';
require_once './MW/AuthRolesMW.php';
require_once './MW/AuthMWLogeado.php';
require_once './MW/AuthParametrosConsultas.php';
require_once './MW/AuthConfirmarPerfil.php';

define('BASEPATH', __DIR__);


$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

//Login
$app->post('/login', \UsuarioController::class .':Login');

//usuarios
$app->group('/usuarios', function (RouteCollectorProxy $group) {
    $group->post('/registro', \UsuarioController::class . ':CargarUno')->add (new chekRolesMW());
})->add(new AuthConfirmarPerfil());


//articulos
$app->group('/tienda', function (RouteCollectorProxy $group) {
    $group->post('/alta', \TiendaControllers::class . ':CargarUno')->add(new AuthArticulosTipoMW())->add(new AuthArticulosTalleMW())->add(new AuthAdminMW());
    $group->post('/consultar', \TiendaControllers::class . ':ConsultaExiste')->add(new AuthAdminMW());
    $group->get('/consultar/productos/entreValores', \TiendaControllers::class . ':ConsultaProdValores')->add(new AuthEmpleadoMW())->add(new AuthEntreValore());
    $group->get('/consultar/productos/masVendido', \TiendaControllers::class . ':ConsultaProdMasVendido')->add(new AuthEmpleadoMW());
})->add(new AuthConfirmarPerfil());

//venta
$app->group('/venta', function (RouteCollectorProxy $group) {
    $group->post('/alta', \VentaControllers::class . ':CargarUno')->add(new AuthArticulosTiendaMW())->add(new AuthEmpleadoMW()); 
    $group->get('/consultar/productos/vendidos', \VentaControllers::class . ':ConsultaProductosVendidos')->add(new AuthProducVendido());
    $group->get('/consultar/porUsuario', \VentaControllers::class . ':ConsultaVentaUsuario')->add(new AuthEmpleadoMW())->add(new AuthConsultaVentaUsuario());
    $group->get('/consultar/porProducto', \VentaControllers::class . ':ConsultaPorProducto')->add(new AuthEmpleadoMW())->add(new AuthPorProducto());
    $group->get('/consultar/ingresos', \VentaControllers::class . ':ConsultaPorIngreso')->add(new AuthAdminMW());
    $group->put('/modificar', \VentaControllers::class . ':modVenta')->add(new AuthVenta())->add(new AuthAdminMW());
    $group->get('/descargar', \VentaControllers::class . ':ExportarCsv')->add(new AuthAdminMW());
})->add(new AuthConfirmarPerfil());


$app->run();