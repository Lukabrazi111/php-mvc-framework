<?php

namespace app\core;

class Request
{
    /**
     * Get path from server.
     *
     * @return mixed|string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getBody()
    {
        $body = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    /**
     * Check if method is get from super global variable.
     *
     * @return bool
     */
    public function isGet()
    {
        return $this->method() === 'get';
    }

    /**
     * Get method from request.
     *
     * @return string
     */
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Check if method is post from super global variable.
     *
     * @return bool
     */
    public function isPost()
    {
        return $this->method() === 'post';
    }
}