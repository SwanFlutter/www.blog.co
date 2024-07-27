<?php

namespace Controller;

use Traits\Response;

class RouteController
{
    use Response;

    private $route = [];

    public function add($url, $method, $controller, $action)
    {
        $urlPattern = preg_replace_callback('/\{([a-zA-Z0-9_]*)}/', function ($matches) {
            return "(?P<{$matches[1]}>[^/]+)";
        }, $url);

        $this->route[] = [
            'urlPattern' => "#^$urlPattern$#",
            'method' => $method,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function match($requestUrl, $requestMethod): bool
    {
        $requestUrl = $this->sanitizeInput($requestUrl);
        $requestMethod = $this->sanitizeInput($requestMethod);

        foreach ($this->route as $route) {
            if ($route['method'] === $requestMethod) {
                if (preg_match($route['urlPattern'], $requestUrl, $matches)) {
                    $controller = $route['controller'];
                    $action = $route['action'];
                    unset($matches[0]);
                    $this->callControllerAction($controller, $action, $matches);
                    return true;
                }
            }
        }
        $this->jsonMsg(false, "Invalid URL", 404);
        return false;
    }

    private function callControllerAction($controller, $action, $matches): void
    {
        $controller = $this->sanitizeInput($controller);
        $action = $this->sanitizeInput($action);
        $matches = $this->sanitizeInput($matches);

        $controller = new $controller();
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], $matches);
        } else {
            throw new \Exception("Method $action not found in $controller");
        }
    }


}