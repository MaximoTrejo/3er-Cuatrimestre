<?php

/*
*Aplicacion No 1 (Sumar numeros) Confeccionar un 
un programa que sume todos los numeros enteros 
desde 1 mientras la suma supere a 1000.
Mosrar los numeros sumados  y al finalizar el 
proceso indicar cuentas numeros se sumaron 
*/

$numeros=0;
$suma = 0; 

while(($suma + $numeros) < 1000){
    $numeros ++;    
    $suma += $numeros;
    echo "los numeros sumados son ". $numeros;
    echo "<br/>";

}

echo "El ultimo numero es: " . $numeros;
echo "<br/>";
echo "La suma es de :" . $suma;
echo "<br/>";



?>
