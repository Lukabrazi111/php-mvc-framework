<?php

namespace app\core;

class Application
{
    public static string $ROOT_PATH;
    public Router $router;
    public Request $request;

    public function __construct($rootPath)
    {
        self::$ROOT_PATH = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}