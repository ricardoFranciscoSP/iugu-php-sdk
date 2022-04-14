<?php

namespace bubbstore\Iugu\Exceptions;

use Exception;

class IuguValidationException extends Exception
{
    /** @var array $errors */
    private $errors;

    /**
     * IuguValidationException constructor.
     * @param $message
     * @param $code
     * @param array $errors
     */
    public function __construct($message, $code, $errors = [])
    {
        $this->errors = $errors;
        parent::__construct($message, $code);
    }

    /**
     * @return array|mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
