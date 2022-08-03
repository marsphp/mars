<?php

namespace App\Exceptions;

class MethodNotAllowedException extends \JsonException
{
    protected $message = 'Method not allowed';
}