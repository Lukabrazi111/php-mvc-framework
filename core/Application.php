<?php

namespace app\core;

class Application
{
    public static string $ROOT_PATH;
    public static $app;
    public Router $router;
    public Request $request;
    public Response $response;

    public function __construct($rootPath)
    {
        self::$app = $this;
        self::$ROOT_PATH = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}