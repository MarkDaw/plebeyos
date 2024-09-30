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
    include("./functions_4inarow.php");
    $player = '';
    $col = 0;
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['col'])) {
            $col = $_POST['col'];
        }

        if (isset($_POST['player'])) {
            $player = $_POST['player'];
        }

        if ($col < 0 || $col > 7 || ($player != 'player1' && $player != 'player2')) {
            echo "<p class=\"incorrect\">Has introducido valores inválidos</p>";
        } else {
            $grid = initGrid();
            ferMoviment($grid, $col, $player);

            printGrid($grid);

        }


    } else {
        $grid = initGrid();


        printGrid($grid);
    }
    ?>
    <form action="" method="post">
        <input type="number" name="col" id="col">
        <label>player1<input type="radio" name="player" id="player" value="player1" checked></label>
        <label>player2<input type="radio" name="player" id="player" value="player2"></label>

        <input type="submit" value="Enviar">
    </form>

</body>

</html>