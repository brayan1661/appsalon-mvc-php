<?php

namespace Controllers;//recordar que el name space es el que esta asociado a esta carpeta

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{
    public static function index(){
        $servicios = Servicio::all();
        

        //FUNCION PARA CONVERTIT NUESTROS ARREGLOS U OBJETOS EN JSON
        echo json_encode($servicios);
    }




    //ESTA FUNCION ESTA RELACIONADA CON EL SUBMIT DE ENVAIR LOS DATOS CUANDO HAGAMOS LA CITA
    public static function guardar(){

        //ALMACENA LA CITA Y DEVUELVE EL ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();//aqui guardamos la cita, recordar que este resultado ya nos trae el id en Active Record en la linea 165 y biene como arreglo entonces este resultado nos va retorna el true o false de active record entonces colocamos abajo

        $id = $resultado['id'];





        //ALMACENA LOS SERVICIOS CON EL ID DE LA CITA
        //EXPLODE ES PARA SEPARAR POR COMAS
        $idServicios = explode(",", $_POST['servicios']);//toma 2 parametros el separador que van hacer las comas y lo que vamos a searar que son que es el post, aqui ya queda como un arreglo sepatrado por comas
        //ENTONCES COMO idServicios es un arreglo podemos colocar un foreach
        foreach($idServicios as $idServicio){
            //AQUI PODEMOS REALIZAR EL CONSTRUCTOR DE CITAservicios, recordar que no le pasamo el id del constructor porque aqui sera un registro nuevo, solo citaId, y servicioId
            $args = [
                'citaId' => $id,//le ponemos flecha de arreglo asociativo y decimos cita id sera igual al id de arriba al de la linea 27
                'servicioId' => $idServicio//de esta forma lo que va ir haciendo es instanciar cuantos id halla disponibles en $idServicios 
            ];
            $citasServicio = new CitaServicio($args);// esto ya nos importa el modelo arriba de citaServicio y le pasamos los argumentos, esto nos crea una nueva instancia de cita servico detecta,citaid ,servicioid los agrega esos atributos del modelo CitaServicio.php y dice no hay ningun id , por lo tanto cuando yo llame el metodo guardar pus lo va insertar en la base de datos
            $citasServicio->guardar();//asi lo va ir guardando y ste for each va ir iterando ba ir guardadno cada uno de los servicios con la referencia de la cita
        }




        //RETORNAMOS UNA RESPUESTA
        //ALMACENA LA CITA Y LOS SERVICIOS ES UNA RELACION DE MUCHOS A MUCHOS
        //$respuesta = [//resultado va ser igual a un arreglo asociativo
        //    'resultado' => $resultado//este resultado es la consulta de la parte superior en la linea 26
        //];

        //$respuesta = [
        //    'cita' => $cita//ESTE ES UN ARREGLO ASOCIATIVO, despues de utilizar la funcion son_encode lo va convertir en un json y este json lo podemos leer en javaScript, porque un arreglo asociativo es equivalente a un objeto en javaScript
        //];

        echo json_encode(['resultado' => $resultado]);
    }




    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){//AQUI ESTAMOS MANDANDO A LLAAMR CON POST EL CAMPO oculto que es id
            $id = $_POST['id'];
            //debuguear($_SERVER); 
            




            $cita = Cita::find($id);//EN ACTIVE RECORD TENEMOS UN METODO QUE SE LLAMA FIND Y LE PASAMOS EL id, y aqui en este codigo ya encontramos la cita que queremos eliminar
            //debuguear($cita);
            $cita->eliminar();//en ative record tenemos el metodo de eliminar entonces mandamos a llamar ese metodo
            header('location:' . $_SERVER['HTTP_REFERER']);//ESTE HTTP_REFERER SALE DE DEBUGURA SERVER ARRIBA EN LA LINEA 70
        }
    }
}