<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Services\Service;
use Joc4enRatlla\Exceptions\InvalidPostException;
use Joc4enRatlla\Exceptions\SameValueException;

class PlayerController {
private Array $players;

    public function __construct($request=null){
    try {
        $this->setPlayers($request);
    } catch (\Throwable $th) {
        loadView('player'); 
        return;
    }
    

    }

    public function setPlayers(Array $request){
        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $request === null || isset($request['user'])) {
            loadView('player'); 
            return;
        }
        

        if(!isset($request['player_name1']) || !isset($request['player_name2']) || !isset($request['player_color1']) || !isset($request['player_color2'])){
            throw new InvalidPostException('Error en el envío del formulari, falten dades');
        }

        if(empty($request['player_name1']) || empty($request['player_name2']) || empty($request['player_color1']) || empty($request['player_color2'])){
            throw new InvalidPostException('Error en el envío del formulari, falten dades o estan buides');
        }

        if($request['player_color1'] === $request['player_color2']){
            throw new SameValueException('Els colors dels jugadors han de ser diferents');
        }

        if($request['player_name1'] === $request['player_name2']){
            throw new SameValueException('Els noms dels jugadors han de ser diferents');
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