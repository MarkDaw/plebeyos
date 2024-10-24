<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Services\Service;



class LoginController {
    public const VALID_USERS = 
    [
        'user1' => 'password1',
        'user2' => 'password2',
        'user3' => 'password3'
    ];

    public function __construct($request=null){

    $this->setUser($request);

    }

    public function setUser(Array $request){

        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $request === null) {
            loadView('login'); 
            return;
        }

        if(!isset($request['user']) || !isset($request['password']) || empty($request['user']) || empty($request['password'])){
            if (!isset($_SESSION['errors'])) {
                $_SESSION['errors'] = [];
            }
            $_SESSION['errors'][] = 'Error en el envío del formulari';
            loadView('login');
            return;
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