<?php 
function initGrid()
{
    $grid = [];
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 7; $j++) {
            $grid[$i][$j] = '';
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

        if ($grid[$i][$col] == '') {
            $grid[$i][$col] = $player;
            break;
        }

    }
}