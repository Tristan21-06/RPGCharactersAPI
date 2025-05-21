<?php

namespace App\Core;

class Router {
    private array $routes = [];
    private Auth $auth;
    public function __construct()
    {
        $this->auth = new Auth();
    }

    public function get($uri, $action) {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action) {
        $this->addRoute('POST', $uri, $action);
    }

    public function patch($uri, $action) {
        $this->addRoute('PATCH', $uri, $action);
    }

    public function delete($uri, $action) {
        $this->addRoute('DELETE', $uri, $action);
    }

    private function addRoute($method, $uri, $action) {
        if (in_array($method, ['PATCH', 'DELETE'])) {
            $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

            $rawBody = file_get_contents('php://input');

            if (stripos($contentType, 'application/json') !== false) {
                $_REQUEST = json_decode($rawBody, true);
            } elseif (stripos($contentType, 'application/x-www-form-urlencoded') !== false) {
                parse_str($rawBody, $_REQUEST);
            } else {
                $_REQUEST = $rawBody;
            }
        }

        $this->routes[] = compact('method', 'uri', 'action');
    }

    public function dispatch($requestUri, $requestMethod) {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($this->convertToRegex($route['uri']), $uri, $matches)) {
                $controllerAction = explode('@', $route['action']);
                $controllerName = $controllerAction[0];
                $methodName = $controllerAction[1];

                if (!$this->auth->checkAuthorization($methodName)) {
                    http_response_code(401);
                    echo json_encode(['error' => 'Unknown token or action not authorized']);
                    die;
                }

                $controller = new $controllerName();
                array_shift($matches);
                return call_user_func_array([$controller, $methodName], $matches);
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    private function convertToRegex($uri) {
        $pattern = preg_replace('#\{[^\}]+\}#', '([a-zA-Z0-9_-]+)', $uri);
        return "#^" . $pattern . "$#";
    }


}