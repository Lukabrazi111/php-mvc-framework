<?php

namespace app\controllers;

use app\core\Application;

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
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_PATH . "/views/$view.php";
        return ob_get_clean();
    }

}