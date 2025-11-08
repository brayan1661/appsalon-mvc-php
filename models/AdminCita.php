<?php

namespace Model;



//ESTE MODELO CONSULTA EL INNER JOIN QUE HEMOS CREADO EN LA BASE DE DATOS CONSULTA 4 TABLAS
class AdminCita extends ActiveRecord{
    protected static $tabla = 'citasservicios';//le decimos que donde va encontrar la mayor informacion sera en citas servicios, y despues ponemos las columnas que hemoc¿s creado con el inner join
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio'];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? null;
    }
}