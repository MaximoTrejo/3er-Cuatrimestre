<?php

session_start();

if(isset( $_SESSION['usuario'])){
    echo $_SESSION['usuario'];
}else{
    $_SESSION['usuario'] = 'franco';
    echo 'No esta seteado , lo seteamos';
}