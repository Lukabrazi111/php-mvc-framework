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

    /**
     * Get method from request.
     *
     * @return string
     */
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}