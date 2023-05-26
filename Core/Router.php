<?php

namespace Core;

class Router
{
    protected array $routes = [];

    protected array $params = [];

    protected array $convertTypes = [
        'd' => 'int',
        'D' => 'string'
    ];

    public function add(string $route, array $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);

        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        $route = '/^'. $route .'$/i';

        $this->routes[$route] = $params;
    }

    public function dispatch($url)
    {
        $url = trim($url, '/');
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            if ($_SERVER['REQUEST_METHOD'] !== $this->params['method']) {
                throw new \Exception('HTTP Method is not a valid');
            }
            unset($this->params['method']);

            if (class_exists($this->params['controller'])) {
                $controller = $this->params['controller'];
                unset($this->params['controller']);

                if (method_exists($controller, $this->params['action'])) {
                    $controller =new $controller;
                    $action = $this->params['action'];
                    unset($this->params['action']);

                    call_user_func_array([$controller, $action], $this->params);
                } else {
                    throw new \Exception("Action '{$this->params['action']}' not found");
                }
            } else {
                throw new \Exception("Controller class {$this->params['controller']} not found");

            }
        } else {
            throw new \Exception('No route matched', 404);
        }
    }

    protected function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                preg_match_all('|\(\?P<[\w]+>\\\\(\w[\+])\)|', $route, $types);

                $step = 0;
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $types[1] = str_replace('+', '', $types[1]);
                        settype($match, $this->convertTypes[$types[1][$step]]);
                        $params[$key] = $match;
                        $step++;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            $url = !str_contains($parts[0], '=') ? $parts[0] : '';
        }

        return $url;
    }

}
