<?php

namespace Model;

class Tarea extends ActiveRecord {
    public static $tabla = 'tareas';
    public static $columnasDB = ['id', 'nombre', 'estado', 'proyectoId'];

    public $id;
    public $nombre;
    public $estado;
    public $proyectoId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['id'] ?? '';
        $this->estado = $args['id'] ?? 0;
        $this->proyectoId = $args['id'] ?? '';
    }
}