<?php
namespace Joc4enRatlla\Exceptions;

class UserException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setSessionError($message);
    }

    private function setSessionError($message)
    {
        
        if (!isset($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }

        $_SESSION['errors'][] = $message;
    }
}