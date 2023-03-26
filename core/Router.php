<?php

namespace app\core;

class Router
{
    public array $routes = [];
    public Request $request;

    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        return $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        return $this->routes['post'][$path] = $callback;
    }

    /**
     * Generate specific route request.
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $this->response->statusCode(404);
            return $this->renderView('_404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($this->isArray($callback) ?? $callback);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_PATH . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_PATH . "/views/$view.php";
        return ob_get_clean();
    }

    public function isArray($callback)
    {
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0];
            $callback[0] = Application::$app->controller;
        }

        return $callback;
    }
}