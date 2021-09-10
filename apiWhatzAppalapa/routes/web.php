<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Http\Response;
use Illuminate\Auth\GenericUser;
//use Laravel\Lumen\Http\ResponseFactory;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/saludo', function() use ($router) {
    $saludo = 'Hello Word!';
    return $saludo;
});

$router->get( '/json', function() {
    $results = app('db')->select( "SELECT * FROM users" );
    var_dump( $results );
    //$data = array( 'error' => false, 'data' => 'No hay información' );
    //return response()->json(['name' => 'Abigail', 'state' => 'CA'], 404);
});

$router->get('/menu', ['middleware' => 'auth', 'uses' => 'ModulesController@getAllModules' ]);


/*
Para habilitar la seguridad por autorizacion debemos de descomentar dos lineas dentro del archivo
bootstrap -> app las cuales son :
    1. routeMiddleware
    2. $app->register(App\Providers\AuthServiceProvider::class);

Posteriormente en el archivo App->Http->Middleware->Authenticate.php en el apartado de
retorno configuramos la respuesta que uno desee presentar al usuario.

Por ultimo la logica para validar los tokens se va a realizar dentro del archivo
App->Providers->AuthServiceProvider.php se ajustara el metodo viaRequest(), donde se
validará la palabra a ser la key y su valor, ejemplo:

$header = $request->header('Api-Token');

if( $header && $header == 'hello' ) {
    return new User();
}
return null;
*/