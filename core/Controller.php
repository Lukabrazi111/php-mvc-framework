<?php

namespace app\core;

class Controller
{
    /**
     * Render view file with params.
     *
     * @param $view
     * @param array $params
     * @return false|string
     */
    public function render($view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}