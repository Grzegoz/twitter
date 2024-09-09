<?php

namespace Artur\Twitter\Core;

use Artur\Twitter\Exceptions\RedirectException;
use Exception;

class Router
{
    private static $routes = [];

    public static function run()
    {
        $request_uri = trim($_SERVER['REQUEST_URI'], '/'); //получаем uri который ввел пользователь затем убираем слеш
        if (isset(self::$routes[$request_uri])) { //проверка существует ли маршрут данного uri
            $controllerData = self::$routes[$request_uri];
            $controllerClass = $controllerData[0]; // возвращаю массив значений и с помощью индексов мы присываиваем значния $controllerClass
            $method = $controllerData[1]; // возвращает массив значений и с помощь индексов мы присваиваем значения переменной $method
            $middlewares = $controllerData[2]; //получаем middleware            
           
            // создаем экземпляр контроллера и вызов метода
            try {
                foreach($middlewares as $middleware) {
                    $middleware->middleware();
                }
                
                $controller = new $controllerClass(); 
                $controller->$method();
            } catch(RedirectException $e) {
                http_response_code(302);
                header("Location: {$e->getUrl()}");
                die();
            } catch(Exception $e) {
                http_response_code(404);
                echo '404 not found' . $e->getMessage();
                die(); 
            }  
        }   
    }


    /**
     * @param IMiddleware[] $middlewares
     */
    public static function add($uri, $controllerClass, $method, ...$middlewares)
    {
        self::$routes[$uri] = [$controllerClass, $method, $middlewares];
    }
}

//преобразует массив экземпляров в массив
// Router::get("/auth", AuthController::class, 'index');




















