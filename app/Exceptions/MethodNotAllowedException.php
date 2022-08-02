<?php

namespace App\Exceptions;

class MethodNotAllowedException extends \Exception
{
    protected $message = 'Method not allowed';
}