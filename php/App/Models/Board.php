<?php
namespace Joc4enRatlla\Models;
/**
 * Clase Board
 *
 * Representa un tablero de juego para el juego de cuatro en línea.
 *
 * @property array $slots Espacios del tablero.
 * @method bool setMovementOnBoard(int $column, string $player) Inserta una ficha en una columna específica.
 * @method bool checkWinner(string $player) Verifica si hay un ganador en el tablero.
 * @method array getSlots() Obtiene los espacios del tablero.
 * @method array initializeBoard() devuelve un tablero vacio.
 * 
 *
 * @const int ROWS Número de filas del tablero.
 * @const int COLUMNS Número de columnas del tablero.
 * @const array DIRECTIONS Direcciones posibles para verificar conexiones.
 */
class Board
{
    public const ROWS = 6;
    public const COLUMNS = 7;
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

    private array $slots;
    
    /**
     * Constructor de la clase.
     *
     * Inicializa una nueva instancia de la clase con el tablero vacío.
     *
     */
    public function __construct(){
        $this->slots = self::initializeBoard();
    }
     
    /**
     * Obtiene los espacios del tablero.
     *
     * @return array Un arreglo que contiene los espacios del tablero.
     */
    public function getSlots(): array{
        return $this->slots;
    }

    /**
     * Inicializa el tablero.
     *
     * @return array Un arreglo que representa el tablero inicializado.
     */
    private static function initializeBoard(): array {
        return array_fill(0, self::ROWS, array_fill(0, self::COLUMNS, 0));
    }

    /**
     * Establece un movimiento en el tablero para un jugador específico.
     *
     * @param int $column La columna en la que se realizará el movimiento.
     * @param int $player El identificador del jugador que realiza el movimiento.
     * @return array Devuelve el estado actualizado del tablero después del movimiento.
     */
    public function setMovementOnBoard(int $column, int $player): array {
        $coords = [$column, $player];
        for($i = self::ROWS - 1; $i >= 0; $i-- ){
            if($this->slots[$i][$column] !== 0) continue;
            $this->slots[$i][$column] = $player;
            $coords[0] = $i;
            $coords[1] = $column;
            break;
        }

        return $coords;
    }

    /**
     * Verifica si hay una condición de victoria en el tablero.
     *
     * @param array $coord Coordenadas a verificar en el formato [row, column].
     * @return bool Devuelve true si hay una condición de victoria, false en caso contrario.
     */
    public function checkWin(array $coord): bool {
        $row = $coord[0];
        $col = $coord[1];
        $player = $this->slots[$row][$col];

        foreach (self::DIRECTIONS as $direction) {
            $count = 1;

            $count += $this->countInDirection($row, $col, $direction[0], $direction[1], $player);
            // Check contrario
            $count += $this->countInDirection($row, $col, -$direction[0], -$direction[1], $player);

            if ($count >= 4) {
            return true;
            }
        }

        return false;
    }

        
    

    /**
     * Cuenta la cantidad de fichas consecutivas en una dirección específica para un jugador dado.
     *
     * @param int $row La fila inicial desde donde comenzar a contar.
     * @param int $col La columna inicial desde donde comenzar a contar.
     * @param int $dRow La dirección de la fila (incremento o decremento).
     * @param int $dCol La dirección de la columna (incremento o decremento).
     * @param int $player El identificador del jugador cuyas fichas se están contando.
     * @return int La cantidad de fichas consecutivas en la dirección especificada.
     */
    private function countInDirection(int $row, int $col, int $dRow, int $dCol, int $player): int {
        $count = 0;
        $r = $row + $dRow;
        $c = $col + $dCol;

        while ($r >= 0 && $r < self::ROWS && $c >= 0 && $c < self::COLUMNS && $this->slots[$r][$c] === $player) {
            $count++;
            $r += $dRow;
            $c += $dCol;
        }

        return $count;
        }

    /**
     * Verifica si un movimiento es válido en la columna especificada.
     *
     * @param int $column La columna en la que se desea realizar el movimiento.
     * @return bool Devuelve true si el movimiento es válido, de lo contrario false.
     */
    public function isValidMove(int $column): bool {

        if($column < 0 || $column > self::COLUMNS-1) return false;

        for($i = self::ROWS - 1; $i >= 0; $i-- ){
            if($this->slots[$i][$column] === 0) return true;
            
        }
        return false;
    }

    public function isFull(): bool {
        for($i = 0; $i < self::COLUMNS; $i++){
            if($this->isValidMove($i)) return false;
        }
        return true;
    }
}