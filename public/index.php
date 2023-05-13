<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use Controllers\TareaController;
use MVC\Router;
$router = new Router();

//AQUI SE COLOCA LOS ENDPOINT


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();