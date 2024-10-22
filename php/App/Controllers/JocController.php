<?php

namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Services\Service

class JocController
{
private Game $game;

// Request és l'array $_POST

public function __construct($request=null)
{
    $this->play($request);
}

public function play(Array $request)  
{
    // Gestió del joc

    $board = $this->game->getBoard();
    $players = $this->game->getPlayers();
    $winner = $this->game->getWinner();
    $scores = $this->game->getScores();

    loadView('index',compact('board','players','winner','scores'));
 }



}