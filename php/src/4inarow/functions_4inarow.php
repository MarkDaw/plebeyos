<?php
function initGrid()
{
    $grid = [];
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 7; $j++) {
            $grid[$i][$j] = 'buid';
        }
    }
    return $grid;
}

function printGrid($grid, $player)
{   
    if(($player === 'player1' || $grid == initGrid()) && !checkFourInARow($grid)) {
    ?>
    
    <form id="colsform" action="" method="post">
    <input type="number" name="col" id="col" style="display: none">
    <?php 
    for($i = 0; $i < count($grid[0]); $i++){
        $temp = $i+1;
        echo "<button data-value=\"$temp\">Columna $temp</button>";
    }
    echo "</form>";
    }
    echo "<table>";

    foreach ($grid as $row) {
        echo "<tr>";
        foreach ($row as $item) {
            echo "<td class=\"$item\"></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

function ferMoviment(&$grid, $col, $player)
{
    for ($i = count($grid) - 1; $i >= 0; $i--) {

        if ($grid[$i][$col] == 'buid') {
            $grid[$i][$col] = $player;
            break;
        }

    }
}

function isColumnFull($grid, $col)
{
    $rows = count($grid);

    for ($i = 0; $i < $rows; $i++) {
        if ($grid[$i][$col] === 'buid') {
            return false;
        }
    }
    return true;
}

function checkIsFull($grid)
{
    $isFull = true;
    foreach ($grid as $row) {
        if (in_array('buid', $row))
            $isFull = false;
    }
    return $isFull;
}


function checkFourInARow(&$grid)
{
    $counter = 0;
    $currentPlayer = 'buid';
    foreach ($grid as $row) {
        $counter = 0;
        $currentPlayer = 'buid';
        foreach ($row as $item) {
            if ($item === 'buid'){
                $counter = 0;
            }


            if ($item != $currentPlayer) {
                $currentPlayer = $item;
                $counter = 1;
            } else {
                $counter++;
                if ($counter >= 4)
                    return true;
            }
        }
    }



    for ($j = 0; $j < count($grid[0]); $j++) {
        $counter = 0;
        $currentPlayer = 'buid';
        for ($i = 0; $i < count($grid); $i++) {
            if ($grid[$i][$j] === 'buid')
                continue;

            if ($grid[$i][$j] != $currentPlayer) {
                $currentPlayer = $grid[$i][$j];
                $counter = 1;
            } else {
                $counter++;
                if ($counter >= 4)
                    return true;
            }
        }
    }

    $counter = 0;


    for ($i = 0; $i < count($grid) - 3; $i++) {
        for ($j = 0; $j < count($grid[0]) - 3; $j++) {
            $currentPlayer = $grid[$i][$j];
            if (
                $currentPlayer !== 'buid' &&
                $currentPlayer === $grid[$i + 1][$j + 1] &&
                $currentPlayer === $grid[$i + 2][$j + 2] &&
                $currentPlayer === $grid[$i + 3][$j + 3]
            ) {
                return true;
            }
        }
    }

    $counter = 0;


    for ($i = 3; $i < count($grid); $i++) {
        for ($j = 0; $j < count($grid[0]) - 3; $j++) {
            $currentPlayer = $grid[$i][$j];
            if (
                $currentPlayer !== 'buid' &&
                $currentPlayer === $grid[$i - 1][$j + 1] &&
                $currentPlayer === $grid[$i - 2][$j + 2] &&
                $currentPlayer === $grid[$i - 3][$j + 3]
            ) {
                return true;
            }
        }
    }




    return false;
}

function jugar($grid, $jugadorActual)
{
    $opponent = $jugadorActual === 'player1' ? 'player2' : 'player1';

    // Comprobar si la IA puede ganar
    for ($col = 0; $col < 7; $col++) {
        if (!isColumnFull($grid, $col)) {
            $tempBoard = $grid;
            ferMoviment($tempBoard, $col, $jugadorActual);
            if (checkFourInARow($tempBoard)) {
                return $col; // Si puede ganar, devuelve esta columna
            }
        }
    }

    // Comprobar si el oponente puede ganar y bloquear
    for ($col = 0; $col < 7; $col++) {
        if (!isColumnFull($grid, $col)) {
            $tempBoard = $grid;
            ferMoviment($tempBoard, $col, $opponent);
            if (checkFourInARow($tempBoard)) {
                return $col; // Si el oponente puede ganar, bloquea
            }
        }
    }

    // Estrategia: elegir una columna disponible al azar
    $availableCols = [];
    for ($col = 0; $col < 7; $col++) {
        if (!isColumnFull($grid, $col)) {
            $availableCols[] = $col;
        }
    }

    if (count($availableCols) > 0) {
        // Elegir una columna aleatoria entre las disponibles
        $randomIndex = rand(0, count($availableCols) - 1);
        return $availableCols[$randomIndex];
    }

    return -1; // No hay movimientos válidos, tablero lleno
}
