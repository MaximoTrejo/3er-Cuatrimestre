<?php
echo "GET";
echo "<br>";
var_dump($_GET);
echo "<br>";


echo "SERVER";
echo "<br>";
var_dump($_SERVER['REQUEST_METHOD']);
echo "<br>";



echo "POST";
echo "<br>";
var_dump($_POST);
//echo  "<br> hola".$_GET['nombre'];
echo "<br>";


echo "REQUEST";
echo "<br>";
var_dump($_REQUEST);
echo "<br>";