<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Setup</title>
    <link rel="stylesheet" href="/css/player.css">
</head>
<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/error.view.php'  ?>

    <h1>Set Players</h1>

    <form action="" method="POST">
        <fieldset>
            <legend>Player 1</legend>
            <label for="player_name1">Name:</label>
            <input type="text" name="player_name1" id="player_name1" required>
            <br>
            <label for="player_color1">Color:</label>
            <input type="color" name="player_color1" id="player_color1" value="#ff0000" required>
        </fieldset>

        <fieldset>
            <legend>Player 2</legend>
            <label for="player_name2">Name:</label>
            <input type="text" name="player_name2" id="player_name2" required>
            <br>
            <label for="player_color2">Color:</label>
            <input type="color" name="player_color2" id="player_color2" value="#ffff00" required>
            <br>
            <label for="player2_isAutomatic">Is Automatic:</label>
            <input type="checkbox" name="player2_isAutomatic" id="player2_isAutomatic" value="true">
        </fieldset>

        <button type="submit">Set Players</button>
    </form>

   
</body>
</html>
