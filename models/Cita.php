<?php
namespace Model;


//ALMACENANDO LAS CITAS EN POSTMAN Y EN LA BASE DE DATOS
class Cita extends ActiveRecord{
    //BASES DE DATOS
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId' ];//recordar que aqui antes de imprimirlo en pantalla ya lo estamos sanitizando desde active record en la funcion atributos NOTA: columnasDB ES cuando creamos el objeto con lo que hay en la base de datos que en este caso son los servicios que ofrecemos en appsalon, lo sanitizamos


    //ESTOS ATRIBUTOS SIGUIENTES SIRVEN CUANDO INSTANCIAMOS CUANDO CREAMOS UNA NUEVA CITA CON LO QUE EL USUARIO NOS DA, AHI CREAMOS LA FORMA DE LOS DATOS PARA DESPUES PASARLO A ACTIVE RECORD
    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;//todos estos practicamente son una copia de los que hay arriba en protected static columnasDB


    //DEFINIMOS NUESTRO CONSTRUCTOR
    public function __construct($args = [])
    {
        $this->id = $args ['id'] ?? null;
        $this->fecha = $args ['fecha'] ?? '';
        $this->hora = $args ['hora'] ?? '';
        $this->usuarioId = $args ['usuarioId'] ?? '';
    }
}