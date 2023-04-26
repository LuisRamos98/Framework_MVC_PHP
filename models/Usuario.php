<?php

namespace Model;

use Model\ActiveRecord;

class Usuario extends ActiveRecord {

    public static $tabla = 'usuarios';
    public static $columnasDB = ['id','nombre','email','password','token','confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '';
    }

    public function validadNuevaCuenta () {
        
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El email del usuario es obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'El password del usuario es obligatorio';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password del usuario requiere de mínimo 6 caracteres';
        }

        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'El password debe coincidir';
        }

        return self::$alertas;
    }

}