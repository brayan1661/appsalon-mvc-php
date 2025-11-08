<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        session_start();
        //INICIAMOS SESION PARA QUE SE MUESTREN LAS COSAS COMO NOMBRE hola carlos brayan
        isAdmin();//esta funcion es para proteger todas las rutas esta en la carpeta includes y en el archivo de funciones es importante colocarla siempre despues del session start, en caso de que no sea un administrador lo mandamos para que se loguee 



        //EN ACTIVE RECORD TENEMOS UNA FUNCION QUE NOS DEVUELBE TODOS LOS REGISTROS esto es para poder ver los servicios en el administrador
        $servicios = Servicio::all();





        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],//y ya iniciado sesion le pasamos el nombre
            'servicios' => $servicios
        ]);
    }






    public static function crear(Router $router){
        session_start();
        isAdmin();//esta funcion es para proteger todas las rutas esta en la carpeta includes y en el archivo de funciones es importante colocarla siempre despues del session start, en caso de que no sea un administrador lo mandamos para que se loguee 

        //CREAR VARIABLE DE SERVICIO PARA GUARDAR LOS NUEVOS SERVICIOS
        $servicio = new Servicio();//esta es una instancia de la clase o modelo de servicio y se la pasamos en la vista
        $alertas = [];






        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //VAMOS A LLER LOS DATOS DEL POST
            $servicio->sincronizar($_POST);//en Active Record tenemos esta funcion que lo que hace es el objeto que ya tenemos en memoria lo sincroniza con los datos del post, los asigna en lugar de crear otro objeto lo asigna al objeto existente y lo va sincronizar con los datos de post


            //MANDAMOS A LLAMAR LA FUNCON VALIDAR DEL ARCHIVO Y MODELO Servicio.php
            $alertas = $servicio->validar();
            if(empty($alertas)){//el empty dice si alertas esta vacio entonces empty permite ver si un arreglo esta vacio o no entonces lo guardamos
                $servicio->guardar();//guardamos en la base de datos
                header('location: /servicios');
            }    
        }





        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],//y ya iniciado sesion le pasamos el nombre
            'servicio' => $servicio,//este servicio tiene que ver con la variable de arriba que dice $servicio
            'alertas' => $alertas
        ]);
    }





    public static function actualizar(Router $router){
        session_start();//aqui iniciamos secion para poder actualizar los servicios
        isAdmin();//esta funcion es para proteger todas las rutas esta en la carpeta includes y en el archivo de funciones es importante colocarla siempre despues del session start, en caso de que no sea un administrador lo mandamos para que se loguee 


        if(!is_numeric($_GET['id'])) return;

        $servicio = Servicio::find($_GET['id']);//esta es una instancia de la clase o modelo de servicio y se la pasamos en la vista
        $alertas = [];//todo este codigo es para que cuando estemos en actualziar de los servicios nos traiga de la base de datos lo que vamos a actualizar




        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);


            $alertas = $servicio->validar();


            if(empty($alertas)){//si las alertas estan vacias
                $servicio->guardar();//lo guardamos en la base de datos
                header('location: /servicios');
            }    
        }


        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],//y ya iniciado sesion le pasamos el nombre
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }






    public static function eliminar(){
        session_start();
        isAdmin();//esta funcion es para proteger todas las rutas esta en la carpeta includes y en el archivo de funciones es importante colocarla siempre despues del session start, en caso de que no sea un administrador lo mandamos para que se loguee 



        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('location: /servicios');
        }
    }
}