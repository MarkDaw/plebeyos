<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Services\Service;



class PlayerController {
private Array $players;

    public function __construct($request=null){

    $this->setPlayers($request);

    }

    public function setPlayers(Array $request){
        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $request === null || isset($request['user'])) {
            loadView('player'); 
            return;
        }
        

        if(!isset($request['player_name1']) || !isset($request['player_name2']) || !isset($request['player_color1']) || !isset($request['player_color2'])){
            if (!isset($_SESSION['errors'])) {
                $_SESSION['errors'] = [];
            }
            $_SESSION['errors'][] = 'Error en el envío del formulari1';
            loadView('player');
            return;
        }

        if(empty($request['player_name1']) || empty($request['player_name2']) || empty($request['player_color1']) || empty($request['player_color2'])){
            if (!isset($_SESSION['errors'])) {
                $_SESSION['errors'] = [];
            }
            $_SESSION['errors'][] = 'Error en el envío del formulari2';
            loadView('player');
            return;
        }

        if($request['player_color1'] === $request['player_color2']){
            if (!isset($_SESSION['errors'])) {
                $_SESSION['errors'] = [];
            }
            $_SESSION['errors'][] = 'Els colors dels jugadors han de ser diferents';
            loadView('player');
            return;
        }

        if($request['player_name1'] === $request['player_name2']){
            if (!isset($_SESSION['errors'])) {
                $_SESSION['errors'] = [];
            }
            $_SESSION['errors'][] = 'Els noms dels jugadors han de ser diferents';
            loadView('player');
            return;
        }



        $this->players = [
            'player1' => new Player(
                (isset($request['player_name1']) ? $request['player_name1'] : 'Player 1'),
                (isset($request['player_color1']) ? $request['player_color1'] : 'red'),
            ),
            'player2' => new Player(
                (isset($request['player_name2']) ? $request['player_name2'] : 'Player 3'),
                (isset($request['player_color2'])? $request['player_color2'] : 'yellow'),
                ((isset($request['player2_isAutomatic']) && $request['player2_isAutomatic'] === 'true') ? true : false),
                )
        ];
        
        
        $_SESSION['players'] = serialize($this->players);
    
    
        
    }


}