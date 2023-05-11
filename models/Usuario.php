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
    public $passwordActual;
    public $passwordNueva;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->passwordActual = $args['passwordActual'] ?? '';
        $this->passwordNueva = $args['passwordNueva'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio'; 
        }

        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no válido';
        }

        return self::$alertas;
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

    //VALIDAR EL LOGIN
    public function validarLogin() {

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no válido';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        return self::$alertas;
    }

    //VALIDA PASSWORD
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password mínimo 6 caracteres';
        }
        
        return self::$alertas;
    }

    //VALIDAR QUE LOS CAMPOS DEL FORMULARIO DE PERFIL NO ESTÉN VACIO
    public function validarPerfil() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        return self::$alertas;
    }

    //VALIDA QUE LOS CAMPOS DE DE PASSACTUAL Y PASSNUEVA NO ESTÉN VACÍO
    public function validarCambiarPassword() {
        if(!$this->passwordActual) {
            self::$alertas['error'][] = 'El password actual es obligatorio';
        }
        if(!$this->passwordNueva) {
            self::$alertas['error'][] = 'El password nuevo es obligatorio';
        }
        if(strlen($this->passwordNueva) < 6) {
            self::$alertas['error'][] = 'El password debe contener mínimo 6 carácteres';
        }

        return self::$alertas;
    }

    //Verifica que el passwordActual sea el mismo que password
    public function comprobarPassword() {
        return password_verify($this->passwordActual, $this->password);
    }

    //HASHEA EL PASSWORD
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //CREAR EL TOKEN
    public function crearToken() {
        $this->token = uniqid();
    }

}