<?php


namespace Mars\Routing;

/**
 * Class Response
 *
 * @package Mars\Core
 */
class Response
{

    /**
     * @param int $code
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

}