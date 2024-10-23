<?php
$slots = $board->getSlots();



if($winner !== null){
    echo ($nextPlayer === 1)? "<h1>Ha guanyat el jugador" . $players[2]->getName() ."</h1>":"<h1>Ha guanyat " . $players[1]->getName() ."</h1>";
}elseif($board->isFull()){  
    echo "<h1>Empat</h1>";
}else{
    echo ($players[$nextPlayer]->getIsAutomatic())?"<h1>Turno de la IA</h1>":"<h1>Turno del " . $players[$nextPlayer]->getName() ."</h1>";
    echo '<form id="colsform" action="" method="post">';
    echo '<input type="number" name="col" id="col" style="display: none">';
    for($i = 0; $i < count($slots[0]); $i++){
        $temp = $i+1;
        echo "<button data-value=\"$i\">Columna $temp</button>";
    }
    echo "</form>";
}


echo "<table>";
foreach ($slots as $row) {
    echo "<tr>";
    foreach ($row as $item) {
        echo ($item === 0) ? "<td class=\"empty\"></td>" : "<td class=\"player$item\"></td>";
    }
    echo "</tr>";
}
echo "</table>";