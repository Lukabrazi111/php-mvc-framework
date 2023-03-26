<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';

    /**
     * Render view file with params.
     *
     * @param $view
     * @param array $params
     * @return array|string|string[]|null
     */
    public function render($view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    /**
     * Set layout name file.
     *
     * @param $layout
     * @return mixed
     */
    public function setLayout($layout)
    {
        return $this->layout = $layout;
    }
}