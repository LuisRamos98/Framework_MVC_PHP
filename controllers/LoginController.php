<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router) {

        $titulo = "Inicie Sesión"; 

        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            
        }

        $router->render('auth/login',[
            "titulo" => $titulo
        ]);
    }

    public static function logout() {
        echo "DESDE LOGOUT";

    }

    public static function crear(Router $router) {

        $titulo = 'Crear Cuenta';
        $usuario = new Usuario;
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validadNuevaCuenta();

            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario){
                    Usuario::setAlerta('error','El usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    //registrar el usuario
                }

            }

        }

        $router->render('auth/crear',[
            'titulo' => $titulo,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router) {
        $titulo = 'Olvide Password';

        if($_SERVER["REQUEST_METHOD"] === 'POST') {

        }

        $router->render('auth/olvide', [
            "titulo" => $titulo
        ]);
    }

    public static function restablecer(Router $router) {

        $titulo = 'Restablecer Password';

        if($_SERVER["REQUEST_METHOD"] === 'POST') {

        }

        $router->render('auth/restablecer',[
            "titulo" => $titulo
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje',[
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {

        $router->render('auth/confirmar',[
            'titulo' => 'Confirmar Cuenta'
        ]);
    }
}