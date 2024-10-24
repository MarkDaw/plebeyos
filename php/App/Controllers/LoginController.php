<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Services\Service;
use Joc4enRatlla\Exceptions\InvalidPostException; // Add this line to import the exception class



class LoginController {
    public const VALID_USERS = 
    [
        'user1' => 'password1',
        'user2' => 'password2',
        'user3' => 'password3'
    ];

    public function __construct($request=null){
    try {
        $this->setUser($request);
    } catch (\Throwable $th) {
        loadView('login'); 
        return;
    }

    }

    public function setUser(Array $request){

        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $request === null) {
            loadView('login'); 
            return;
        }

        if(!isset($request['user']) || !isset($request['password']) || empty($request['user']) || empty($request['password'])){
            throw new InvalidPostException('Error en el envío del formulari, falten dades o estan buides');
        }
       
        if (!array_key_exists($request['user'], self::VALID_USERS)) {
            if (!isset($_SESSION['errors'])) {
                $_SESSION['errors'] = [];
            }
            $_SESSION['errors'][] = 'No existeix l\'usuari, PISTA: user1 -> password1; user2 -> password2; user3 -> password3';
            loadView('login');
            return;
        }
    
        if ($request['password'] !== self::VALID_USERS[$request['user']]) {
            if (!isset($_SESSION['errors'])) {
                $_SESSION['errors'] = [];
            }
            $_SESSION['errors'][] = 'Contrasenya invàlida';
            loadView('login');
            return;
        }
        $_SESSION['user'] = $request['user'];
        
    }


}