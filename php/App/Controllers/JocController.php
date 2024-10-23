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

        if(isset($_SESSION['scores'])){
            $this->game->setScores($_SESSION['scores']);
        }else{
            $this->game->setScores([1 => 0, 2 => 0]);
        }

        if($this->game->getWinner() === null && !$this->game->getBoard()->isFull()){
            $this->makeMove($request);

            if($this->game->getWinner() !== null){
                ($this->game->getPlayers()[1]=== $this->game->getWinner())? $this->game->addScore(1, 2) : $this->game->addScore(2, 2);
            }elseif($this->game->getBoard()->isFull()){
                $this->game->addScore(1, 1);
                $this->game->addScore(2, 1);
            }

        }
        

        $board = $this->game->getBoard();
        $players = $this->game->getPlayers();
        $winner = $this->game->getWinner();
        $scores = $this->game->getScores();
        $nextPlayer = $this->game->getNextPlayer();

        

        $_SESSION['game'] = $this->game->save();
        $_SESSION['scores'] = [
            1 => $scores[1],
            2 => $scores[2]
        ];


        loadView('joc',compact('board','players','winner','scores','nextPlayer'));
    }


    private function initGame(Array $request){

        
        if(isset($_SESSION['game'])){
            $this->game = Game::restore();
        }else{
            $jugador1 = new Player('Jugador 1', (isset($_POST['color1']) ? $_POST['color1'] : 'red'));
            $jugador2 = new Player('Jugador 2', (isset($_POST['color2']) ? $_POST['color2'] : 'yellow'));
            $this->game = new Game($jugador1, $jugador2);
        }
    }

    private function makeMove(Array $request){
        if(isset($request['col'])){
            $column = $request['col'];
            
            if(!$this->game->getBoard()->isValidMove($column)){
                if (!isset($_SESSION['errors'])) {
                    $_SESSION['errors'] = [];
                }
                $_SESSION['errors'][] = 'Columna plena';
            }elseif($column < 0 || $column > Board::COLUMNS-1){
                if (!isset($_SESSION['errors'])) {
                    $_SESSION['errors'] = [];
                }
                $_SESSION['errors'][] = 'Columna no vàlida';
            }else{
                $coords = $this->game->play($column);
                if($this->game->getBoard()->checkWin($coords)){

                    $this->game->setWinner($this->game->getPlayers()[($this->game->getNextPlayer() === 1)?2:1]);
                }
            }
            
        }
    }



}