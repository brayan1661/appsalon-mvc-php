<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}




//FUNCION TIENE QUE VER CON EL ARCHIVO DE INDEX.PHP DE LA CARPETA ADMIN EN VIEWS
function esUltimo(string $actual, string $proximo): bool{//nos va retornar un bool
    if($actual !== $proximo){//si el valor actual es diferente al valor proximo significa que es el ultimo vamos a retornar true
        return true;
    }
    //CASO CONTRARIO RETORNAMOS FALSE
    return false;
}




//FUNCION QUE REVISA QUE EL USUARIO ESTE AUTENTICADO
function isAuth() : void {//void no retorna nada
    if(!isset($_SESSION['login'])){//isset es que si esta definida esta variable o existe este valor poenemos session y verificamos por login en el controlador de LoginController en la linea 38 y sabemos que le pusimos un true entonces este va retonar true lo evalua aqui en el if y si no ha iniciado secion el usuario le ponemos un header y lo redireccionamos
        header('location: /');
    }    
}



//FUNCION PARA PROTEGER EL PANEL DE ADMINISTRACION    etsa funcion tiene que ver con AdminController en sesion start
function isAdmin() : void{//como nuestros clientes estan autenticados pueden entrar al panel como administradores entones vamos a evitar eso aqui void quiere decir que no va retornar nada
    if(!isset($_SESSION['admin'])){//esto esta en el login controller ahi indicamos si es un cliente o un administrador, isset va revisar si existe o no iniciado secion como administrador y lo negamos si no esta
        header('location: /');
    }
}