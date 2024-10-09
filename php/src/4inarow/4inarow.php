<?php
session_start();
if(!isset($_SESSION['user']) && !isset($_COOKIE['user-remember'])){
    header('Location: ../login.php?action=login-failed');
}
include("./functions_4inarow.php");
if(!isset($_SESSION['grid'])){
    $_SESSION['grid'] = initGrid();
    $_SESSION['player'] = 'player2';
}

$grid = $_SESSION['grid'];
$col = -1;
$player = $_SESSION['player'];

$userLogged = (isset($_COOKIE['user-remember']))? "<h1>Sesión del usuario " . $_COOKIE['user-remember'] . " mediante cookie</h1>":"<h1>Sesión del usuario " . $_SESSION['user'] . "</h1>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 10px dotted #fff;
            /* Cercle amb punts blancs */
            background-color: #000;
            /* Fons negre o pot ser un altre color */
            display: inline-block;
            margin: 10px;
            color: white;
            font-size: 2rem;
            text-align: center;
            vertical-align: middle;
        }

        .player1 {
            background-color: red;
            /* Color vermell per un dels jugadors */
        }

        .player2 {
            background-color: yellow;
            /* Color groc per l'altre jugador */
        }

        .buid {
            background-color: white;
            /* Color blanc per cercles buits */
            border-color: #000;
            /* Puntes negres per millor visibilitat */
        }
        .incorrect{
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        


        if (isset($_POST['col'])) {
            $col = $_POST['col'] -1;
        }

        if (isset($_SESSION['player'])) {
            $player = $_SESSION['player'];
        }

        if ($col < 0 || $col > 6 || ($player != 'player1' && $player != 'player2') || isColumnFull($grid,$col)) {
            echo "<p class=\"incorrect\">Has introducido valores inválidos</p>";
            $_SESSION['player'] = ($player === 'player1')?'player2':'player1';
            $player = ($player === 'player1')?'player2':'player1';


        } else {
            
            ferMoviment($grid, $col, $player);
            

        }


    }elseif($_SERVER['REQUEST_METHOD'] === 'GET') {

        if (isset($_GET['action']) && $_GET['action'] === 'restart') {
            $player = 'player2';
            $_SESSION['player'] = 'player2';
            $grid = initGrid();
        }

        if ($grid === initGrid() && $_GET['action'] !== 'restart') {
            echo $userLogged ;
        }
        
    }
        
    
    printGrid($grid);
    if(checkFourInARow($grid)){
        echo "<h1>Has ganado $player</h1>";
        $player = 'player2';
        $_SESSION['player'] = 'player2';
        $grid = initGrid();
    }else{
        $player = ($player === 'player1')?'player2':'player1';
        echo "<p>Turno del player: $player</p>";
        ?>
        <form action="" method="post">
            <input type="number" name="col" id="col" autofocus>
            
            <input type="submit" value="Enviar">
        </form>
        <?php 
    }

    $_SESSION['grid'] = $grid;
    $_SESSION['player'] = $player;

    
    ?>

    <p><a href="?action=restart">Reiniciar partida</a></p>
    <p><a href="../login.php?action=login-closed">Cerrar sesión</a></p>


</body>

</html>