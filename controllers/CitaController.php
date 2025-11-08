<?php

namespace Controllers;

use MVC\Router;

class CitaController{
    public static function index(Router $router){

        //session star va arrancar la sesion de nuevo y va llenar en el campo de nombre cuando estamos haciendo la cita
        session_start();
        //debuguear($_SESSION);



        isAuth();//esto va ejecutar la funcion que creamos en el archivo de funciones.php de que el usuario tiene que estar autenticado para iniciar secion



        $router->render('cita/index',[
            'nombre' => $_SESSION['nombre'],//AQui es para pasarle el nombre que pusimos cuando estabamos creando el usuario para cuando estemos haciendo la cita
            'id' => $_SESSION['id']//aqui lo mismo es para que le pasemos el id cuando estemos haciendo la cita
        ]);//vamos a crear una carpeta llamada cita y un archivo llamado index hasi va estar disponible en la vista
    }
}