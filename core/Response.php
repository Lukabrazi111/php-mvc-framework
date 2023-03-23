<?php

namespace app\core;

class Response
{
    /**
     * Receive status code.
     *
     * @param $code
     * @return bool|int
     */
    public function statusCode($code)
    {
        return http_response_code($code);
    }

}