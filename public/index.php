<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();



//INICIAR SESION
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class, 'login']);//aqui es para llenar el formulario con post
$router->get('/logout',[LoginController::class, 'logout']);//aqui para cerrar secion




//RECUPERAR PASSWORD
$router->get('/olvide',[LoginController::class, 'olvide']);//enlace para recuperar contraseÑa
$router->post('/olvide',[LoginController::class, 'olvide']);//formulario para recuperar contraseÑa
$router->get('/recuperar',[LoginController::class, 'recuperar']);//vista para get cuando de click en el enlace que le vamos a enviar cuando le de recuperar contraseña
$router->post('/recuperar',[LoginController::class, 'recuperar']);//en este post vamos a permitirle que agregue una nueva contraseña, se tien que reescribir esa contraseÑa




//CREAR CEUNTA
$router->get('/crear-cuenta',[LoginController::class, 'crear']);//enlace para recuperar contraseÑa
$router->post('/crear-cuenta',[LoginController::class, 'crear']);//formulario para recuperar contraseÑa



//CONFIRMAR CUENTA ESTO ES PARA LO DEL EMAIL
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);








//AREA PRIVADA PARA ESTO YA REQUERIMOS HAVER TENIDO UNA CUENTA Y HABER INICIADO SECION, TODO ESTO ES PARA AREA DE ADMINISTRADOR
$router->get('/cita',[CitaController::class, 'index']);
$router->get('/admin',[AdminController::class, 'index']);

















//API DE CITAS
$router->get('/api/servicios',[APIController::class, 'index']);
$router->post('/api/citas',[APIController::class, 'guardar']);//aqui vamos enviar peticiones al servidor
$router->post('/api/eliminar', [APIController::class, 'eliminar']);//AQUI ES PARA ELIMINAR LAS CITAS EL ADMINISTRADOR PUEDE ELIMINARLAS,   la mayoria de los frameworks ban a soportar delete pero http no lo sopoerta poner delete solo soporta GET y POST







//CRUD DE SERVICIOS
$router->get('/servicios', [ServicioController:: class, 'index']);
$router->get('/servicios/crear', [ServicioController:: class, 'crear']);//este va ser el que muestre el formulario
$router->post('/servicios/crear', [ServicioController:: class, 'crear']);//este va ser el que lee los datos del formulario
$router->get('/servicios/actualizar', [ServicioController:: class, 'actualizar']);//este va ser para mostrar el formulario
$router->post('/servicios/actualizar', [ServicioController:: class, 'actualizar']);//y este post para leer el formulario
$router->post('/servicios/eliminar', [ServicioController:: class, 'eliminar']);//este es para eliminar







// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();