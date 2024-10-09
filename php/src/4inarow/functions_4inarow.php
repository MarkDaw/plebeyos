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

function printGrid($grid)
{
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

function isColumnFull($grid, $col) {
    $rows = count($grid);

    for ($i = 0; $i < $rows; $i++) {
        if ($grid[$i][$col] === 'buid') {
            return false; 
        }
    }
    return true;
}

function checkIsFull($grid){
    $isFull = true;
    foreach ($grid as $row) {
        if(in_array('buid', $row)) $isFull = false;
    }
    return $isFull;
}


function checkFourInARow(&$grid){
    $counter = 0;
    $currentPlayer = 'buid';
    foreach ($grid as $row) {
        $counter = 0;

        foreach ($row as $item) {
            if($item === 'buid') continue;

            if($item != $currentPlayer) {
                $currentPlayer = $item;
                $counter = 1;
            }else{
                $counter++;
                if($counter >= 4) return true;
            }
        }
    }

    

    for ($j = 0; $j <  count($grid[0]); $j++) {
        $counter = 0;
        $currentPlayer = 'buid';
        for ($i = 0; $i <  count($grid); $i++) {
            if ($grid[$i][$j] === 'buid') continue;

            if ($grid[$i][$j] != $currentPlayer) {
                $currentPlayer = $grid[$i][$j];
                $counter = 1;
            } else {
                $counter++;
                if ($counter >= 4) return true; 
            }
        }
    }

    $counter = 0;


    for ($i = 0; $i <  count($grid) - 3; $i++) {
        for ($j = 0; $j <  count($grid[0]) - 3; $j++) {
            $currentPlayer = $grid[$i][$j];
            if ($currentPlayer !== 'buid' &&
                $currentPlayer === $grid[$i+1][$j+1] &&
                $currentPlayer === $grid[$i+2][$j+2] &&
                $currentPlayer === $grid[$i+3][$j+3]) {
                return true; 
            }
        }
    }

    $counter = 0;


    for ($i = 3; $i <  count($grid); $i++) {
        for ($j = 0; $j <  count($grid[0]) - 3; $j++) {
            $currentPlayer = $grid[$i][$j];
            if ($currentPlayer !== 'buid' &&
                $currentPlayer === $grid[$i-1][$j+1] &&
                $currentPlayer === $grid[$i-2][$j+2] &&
                $currentPlayer === $grid[$i-3][$j+3]) {
                return true; 
            }
        }
    }

    


    return false;
}