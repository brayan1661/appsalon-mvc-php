<?php

namespace Model;

class CitaServicio extends ActiveRecord{
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['id', 'citaId', 'servicioId'];



    public $id;
    public $citaId;
    public $servicioId;



    //CREAMOS EL CONSTRUCTOR
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;//esto va ser this->id esto va ser igual a los argumentos en el campo id y en caso de que no este presente sera null
        $this->citaId = $args['citaId'] ?? '';//esto va ser this->id esto va ser igual a los argumentos en el campo id y en caso de que no este presente sera null
        $this->servicioId = $args['servicioId'] ?? '';//esto va ser this->id esto va ser igual a los argumentos en el campo id y en caso de que no este presente sera null
    }
}