<?php
namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController{
    public static function index(Router $router){//este si ba tener api de java Script porque ba consultar la base de datos y v amostrar las citas establecidas ahi entonces le pasamos el router
        session_start();



        isAdmin();//proteger el panel de administracion este codigo esta en los helpers de includes


        //ESTO ES PARA MOSTRAR LA FECHA QUE NOSOTROS ELIJAMOS EN EL CALENDARIO EN EL AREA DE ADMINISTRADOR
        $fecha = $_GET['fecha'] ?? date('Y-m-d');//caso contrario ponemos la fecha del servidor el get es la que ponemos en la url            ////es para mostrar las citas por fecha en la parte del administrador, igriega mayuscula nos da el aÑo y m el mes y la d el dia, recordar que date ba obtener fecha actual del servidor          //ENTONCES BA BUSCAR SI HYA UN GET Y SI NO VA SER LA FECHA DEL SERVIDOR 
        $fechas = explode('-', $fecha);//recordemos que explode es para separa y lo separamos por medo de un guion y lo que vamos a separar es la fecha 

        //debuguear($fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){//en checkdate el primer parametro es el mes, por eso ponemos fecha en la posicion numero 1 del arreglo, el segundo parametro es el dia, y el tercer parametro es el año y en caso de que no pase esa validacion por eso hacemos la negacios
            header('location: /400');//lo enviamos a la ubicacion 404
        }    




        //CONSULTAR LA BASE DE DATOS
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";//ES EL MISMO CODIGO SQL PERO YA ENFOCADO EN PHP
        $consulta .= " WHERE fecha =  '{$fecha}' ";//fecha es la variable que tenemos aRRIBA

        $citas = AdminCita::SQL($consulta);//ya con este codigo va a active Record busca ese metodo SQL y query Y NOS RETORNA UN RESULTADO
        //debuguear($citas);








        
        $router->render('admin/index', [//creamos una vista llamada admin/index para pasarle datos como un arreglo
            'nombre' => $_SESSION['nombre'],//nombre y el valor va benir de session nombre, es el que sale cuando uno esta haciendo una cita
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}