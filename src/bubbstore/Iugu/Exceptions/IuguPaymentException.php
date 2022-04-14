<?php

namespace bubbstore\Iugu\Exceptions;

use Exception;

class IuguPaymentException extends Exception
{

    /**
     * IuguPaymentException constructor.
     * @param $message
     * @param $code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
