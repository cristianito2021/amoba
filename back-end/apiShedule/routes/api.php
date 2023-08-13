<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



$routes = [
    [
        'name' => 'calendar',
        'controller' => CalendarController::class,
        'methods' => 'get, post, put, delete'
    ],
    [
        'name' => 'user',
        'controller' => UserController::class,
        'methods' => 'get, post, put, delete'
    ],
    [
        'name' => 'route',
        'controller' => RouteController::class,
        'methods' => 'get, post, put, delete'
    ],
];

$method_get_actions = ['index', 'show'];
foreach ($routes as $route) {
    $methods = explode(", ", $route['methods']);
    foreach ($methods as $method) {
        switch ($method) {
            case 'get':
                foreach ($method_get_actions as $action) {
                    $plural_verbose = '';
                    switch ($action) {
                        case 'index':
                            $plural_verbose = 's';
                            break;

                        case 'show':
                            $plural_verbose = '/{id}';
                            break;
                    }
                    Route::$method($route['name'].$plural_verbose, [$route['controller'], $action])->middleware('auth:api');
                }
                break;
            case 'post':
                Route::post($route['name'].'/{id}', [$route['controller'], 'store'])->middleware('auth:api');
                break;
            case 'put':
                Route::put($route['name'].'/{id}', [$route['controller'], 'update'])->middleware('auth:api');
                break;
            case 'delete':
                Route::delete($route['name'].'/{id}', [$route['controller'], 'destroy'])->middleware('auth:api');
                break;
        }
    }



}

Route::post('login', [AuthController::class, 'login']);
