<?php

namespace bubbstore\Iugu\Exceptions;

use Exception;

class IuguException extends Exception
{

    /**
     * IuguException constructor.
     * @param $message
     * @param $code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
