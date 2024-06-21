<?php

namespace App\Helpers;

class Route {
    private static array $routes = [];

    public static function get(string $uri, string $action): void {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post(string $uri, string $action): void {
        self::$routes['POST'][$uri] = $action;
    }

    public static function dispatch(): void {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes[$method] as $route => $action) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
            $pattern = str_replace('/', '\/', $pattern);

            if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
                array_shift($matches);
                self::callAction($action, $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private static function callAction(string $action, array $params): void {
        [$controller, $method] = explode('@', $action);
        $controller = "App\\Controllers\\{$controller}";
        $controllerInstance = new $controller();

        if (method_exists($controllerInstance, $method)) {
            call_user_func_array([$controllerInstance, $method], $params);
        } else {
            throw new \Exception("Method {$method} not found in controller {$controller}");
        }
    }
}
