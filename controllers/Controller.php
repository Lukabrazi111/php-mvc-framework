<?php

namespace app\core\controllers;

use app\core\Application;

class Controller
{

    public function render($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_PATH . "/views/$view.php";
        return ob_get_clean();
    }

}