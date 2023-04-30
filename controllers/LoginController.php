<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

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
                    //Hashear el password
                    $usuario->hashPassword();

                    //Eliminar el password2
                    unset($usuario->password2);

                    //Crear el token
                    $usuario->crearToken();

                    //registrar el usuario
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                        $email->enviarConfirmacion();
                        header('Location: /mensaje');
                    }
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
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            
            $usuario = new Usuario($_POST);  
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                //Verificar si el usuario Existe
                $usuario = Usuario::where('email',$usuario->email);

                if($usuario) {
                    //Crea un nuevo token 
                    $token = uniqid();

                    //Actualizar el usuario
                    $usuario->crearToken();
                    unset($usuario->password2);
                    $usuario->guardar();

                    //Enviar mail
                    $mail = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $mail->enviarInstrucciones();

                    //Imprimir alerta
                    Usuario::setAlerta('exito','Hemos enviado las instrucciones a tu email');
                } else {
                    Usuario::setAlerta('error','El Usuario No Existe');

                }
            }
            
        }

        $alertas = Usuario::getAlertas();

        //Muestra la vista
        $router->render('auth/olvide', [
            "titulo" => $titulo,
            "alertas" => $alertas
        ]);
    }

    public static function restablecer(Router $router) {

        $titulo = 'Restablecer Password';
        $alertas = [];
        $token = s($_GET['token']);   
        $mostrar = true;

        if(!$token) {header('Location: /');}

        $usuario = Usuario::where('token',$token);

        if(empty($usuario)) {
            Usuario::setAlerta('error','El token no existe');
            $mostrar = false;
        }
        
        if($_SERVER["REQUEST_METHOD"] === 'POST') {

            $usuario->sincronizar($_POST);

            // debuguear($usuario);

            $alertas = $usuario->validarPassword(); 

            if(empty($alertas)) {
                //Hashear el nuevo password
                $usuario->password = $_POST['password'];
                $usuario->hashPassword();

                //Eliminar el Token
                $usuario->token = null;
                unset($usuario->password2);
                
                //Guardamos en la base de datos
                $resultado = $usuario->guardar();

                if($resultado) {
                    header("Location: /");
                }
            }

        }

        $alertas = Usuario::getAlertas();
        
        //Muestra la vista
        $router->render('auth/restablecer',[
            "titulo" => $titulo,
            "alertas" => $alertas,
            "mostrar" => $mostrar
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje',[
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {

        $token = $_GET['token'];
        $alertas = [];

        if(!$token) {
            header('Location: /');
        } else {
            $usuario = Usuario::where('token', $token);

            if(empty($usuario)) {
                Usuario::setAlerta('error','Token No Válido');
            } else {    
                unset($usuario->password2);
                $usuario->token = null;
                $usuario->confirmado = 1;
                //GUARDAR USUARIO
                $usuario->guardar();
                Usuario::setAlerta('exito', 'Usuario confirmado correctamente');

            }            

            $alertas = Usuario::getAlertas();
        }

        $router->render('auth/confirmar',[
            'titulo' => 'Confirmar Cuenta',
            'alertas' => $alertas
        ]);
    }
}