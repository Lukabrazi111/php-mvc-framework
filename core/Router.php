<?php

namespace app\core;

class Router
{
    public array $routes = [];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Generate specific route request.
     *
     * @return false|string
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            return 'Not found!';
        }

        return $this->renderView($callback);
    }

    public function renderView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_PATH . "/views/$view.php";
        return ob_get_clean();
    }

    public function get($path, $callback)
    {
        return $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        return $this->routes['post'][$path] = $callback;
    }

}