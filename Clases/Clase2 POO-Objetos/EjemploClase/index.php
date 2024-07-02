<?php 
//llamado a archivos
require_once './Usuario.php';
require_once './Empleado.php';
//usuarios
$usuariosconapellido = new Usuario('Franco','Lippii');

echo $usuariosconapellido->mostrar();
echo "<br/>";
$usuariosSinApellido = new Usuario('Franco');

echo $usuariosSinApellido->mostrar();
echo "<br/>";
//estaticos 
echo "cantidad usuarios".Usuario::cantidadUsuarios();
echo "<br/>";

//empleado 
$empleado  = new Empleado('Agustin');

echo $empleado->mostrar();
