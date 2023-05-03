<?php 

namespace Controllers;

use MVC\Router;

class DashboardController {
    public static function index(Router $router) {

        session_start();

        //MOSTRAR LA VISTA
        $router->render('dashboard/index',[
            'titulo' => 'Dashboard'
        ]);
    }
}