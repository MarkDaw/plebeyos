<?php 
namespace Joc4enRatlla\Models;

use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Models\Player;

class Game
{
    private Board $board;
    private int $nextPlayer;
    private array $players;
    private ?Player $winner;
    private array $scores = [1 => 0, 2 => 0];

    public function __construct( Player $jugador1, Player $jugador2){
        $this->board = new Board();
        $this->nextPlayer = 1;
        $this->players = [1 => $jugador1, 2 => $jugador2];
        $this->winner = null;
    }



    public function getBoard(): Board
    {
        return $this->board;
    }

    public function setBoard(Board $board): void
    {
        $this->board = $board;
    }

    public function getNextPlayer(): int
    {
        return $this->nextPlayer;
    }

    public function setNextPlayer(int $nextPlayer): void
    {
        $this->nextPlayer = $nextPlayer;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function setPlayers(Player $jugador1, Player $jugador2): void
    {
        $this->players = [1 => $jugador1, 2 => $jugador2];
    }

    public function getWinner(): ?Player
    {
        return $this->winner;
    }

    public function setWinner(?Player $winner): void
    {
        $this->winner = $winner;
    }

    public function getScores(): array
    {
        return $this->scores;
    }

    public function setScores(array $scores): void
    {
        $this->scores = $scores;
    }

    public function addScore(int $key, int $value): void
    {
        $this->scores[$key] += $value;
    }

    public function reset(): void{
        $this->board = new Board();
    } 

    public function play($column){
        $result = $this->board->setMovementOnBoard($column, $this->nextPlayer);
        $this->nextPlayer = $this->nextPlayer === 1 ? 2 : 1;
        return $result;
    }

    public function playAutomatic(){
        $opponent = $this->nextPlayer === 1 ? 2 : 1;

        for ($col = 0; $col <= Board::COLUMNS-1; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $this->nextPlayer);

                if ($tempBoard->checkWin($coord)) {
                    
                    return $this->play($col);
                }
            }
        }

        for ($col = 0; $col <= Board::COLUMNS-1; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $opponent);
                if ($tempBoard->checkWin($coord )) {
                    
                    return $this->play($col);
                }
            }
        }

        $possibles = array();
        for ($col = 0; $col <= Board::COLUMNS-1; $col++) {
            if ($this->board->isValidMove($col)) {
                $possibles[] = $col;
            }
        }
        $random = 0;
        if (count($possibles)>2) {
            $random = rand(-1,1);
        }
        $middle = (int) (count($possibles) / 2)+$random;
        $inthemiddle = $possibles[$middle];
        return $this->play($inthemiddle);
    }

    public function save(){
        return serialize($this);
    }  

    public static function restore(){
        return unserialize($_SESSION['game']);
    }
}