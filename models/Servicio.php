<?php

namespace Model;

class Servicio extends ActiveRecord{//eredamos de active record porque ahi todavia ocupamos de unas funciones
    //BASES DE DATOS LA CONFIGURACION
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];//esto ya nos crea un objeto igual a la que hay en la base de datos



    //AHORA VAMOS A REGISTRAR LOS ATRIBUTOS
    public $id;
    public $nombre;
    public $precio;



    //DEFINIMOS NUESTRO CONSTRUCTOR
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;//recordar que esto es un arreglo asociativo y caso contrario le ponemos null
        $this->nombre = $args['nombre'] ?? '';//en caso de que no este presente sera un string vacio
        $this->precio = $args['precio'] ?? '';//en caso de que no este presente sera un string vacio
    }





    //ESTA FUNCION ES TANTO COMO PARA CREAR Y ACTUALIZAR LOS SERVICIOS Y TENEMOS LA MISMA VALIDACION de  errores PARA AMBOS
    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'EL NOMBRE DEL SERVICIO ES OBLIGATORIO';//lo agregamos al final de este arreglo eso significa la segunda llave
        }



        if(!$this->precio){
            self::$alertas['error'][] = 'EL PRECIO DEL SERVICIO ES OBLIGATORIO';//lo agregamos al final de este arreglo eso significa la segunda llave
        }

        if(!is_numeric($this->precio)){//SI lo que escribe el usuario es numerico no lo dejes pasar 
            self::$alertas['error'][] = 'no es un formato valido de precio, tiene que ser numeros';//lo agregamos al final de este arreglo eso significa la segunda llave
        }


        return self::$alertas;
    }

}