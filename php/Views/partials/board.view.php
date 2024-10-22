<?php
echo "<table>";

foreach ($board as $row) {
    echo "<tr>";
    foreach ($row as $item) {
        if($item === 0) echo "<td class=\"empty\"></td>";
        echo "<td class=\"player$item\"></td>";
    }
    echo "</tr>";
}
echo "</table>";