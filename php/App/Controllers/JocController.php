<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Services\Service;

class JocController {
private Game $game;

    public function __construct($request=null){

    $this->play($request);

    }

    public function play(Array $request){
        
        $this->initGame($request);

        $this->makeMove($request);



        $board = $this->game->getBoard();
        $players = $this->game->getPlayers();
        $winner = $this->game->getWinner();
        $scores = $this->game->getScores();

        $_SESSION['game'] = $this->game->save();

        loadView('index',compact('board','players','winner','scores'));
    }


    private function initGame(Array $request){
        if(isset($request['reset'])){
            unset($_SESSION['game']);
            $jugador1 = new Player('Jugador 1', (isset($_COOKIE['color1']) ? $_COOKIE['color1'] : 'red'));
            $jugador2 = new Player('Jugador 2', (isset($_COOKIE['color2']) ? $_COOKIE['color2'] : 'yellow'));
            $this->game = new Game($jugador1, $jugador2);
        }elseif(isset($_SESSION['game'])){
            $this->game = Game::restore();
        
        }elseif($this->game == null){
            $jugador1 = new Player('Jugador 1', (isset($_COOKIE['color1']) ? $_COOKIE['color1'] : 'red'));
            $jugador2 = new Player('Jugador 2', (isset($_COOKIE['color2']) ? $_COOKIE['color2'] : 'yellow'));
            $this->game = new Game($jugador1, $jugador2);
        }
    }

    private function makeMove(Array $request){
        if(isset($request['column'])){
            $column = $request['column'];
            
            if(!$this->game->getBoard()->isValidMove($column)){
                if (!isset($_SESSION['errors'])) {
                    $_SESSION['errors'] = [];
                }
                $_SESSION['errors'][] = 'Columna plena';
            }else{
                $this->game->play($column);
            }
            
        }
    }



}