<?php
namespace Joc4enRatlla\Exceptions;

use Joc4enRatlla\Exceptions\UserException;

class InvalidPostException extends UserException
{
    public function __construct($message = "Invalid post data", $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}