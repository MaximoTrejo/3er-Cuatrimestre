<?php

if(isset($_COOKIE['nombre'])){
    echo 'La cookie esta creada y el valor es :' . $_COOKIE['nombre'];

}else{
    echo 'La cookie no existe ,se crea';
    //se crea la cookie y se le asigna un tiempo de vida 
    setcookie('nombre','franco',time()+ (60*2));
    //si se le asigna un valor negativo la cookie se borra 
}


