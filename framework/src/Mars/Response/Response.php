<?php

namespace Mars\Response;

class Response
{

    protected $body;

    protected int $statusCode = 200;

    protected array $headers = [];

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    public function withStatus($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function withJson($body)
    {
        $this->withHeader('Content-Type', 'application/json');
        $this->body = json_encode($body);
        return $this;
    }

    public function withHeader($name, $value)
    {
        $this->headers[] = [$name, $value];
        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

}