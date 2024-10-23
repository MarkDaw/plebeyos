<html>
<head>
    <link rel="stylesheet" href="/css/4enRatlla.css">
    <title>4 en ratlla</title>
    <script src="/js/board.js" defer></script>
    <style>
        .player1 {
            background-color: <?= $players[1]->getColor() ?> ; /* Color vermell per un dels jugadors */
        }

        .player2 {
            background-color:  <?= $players[2]->getColor() ?>; /* Color groc per l'altre jugador */
        }

    </style>
</head>
<body>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/error.view.php'  ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/board.view.php'  ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/score.view.php'  ?>

<div class="actions">
    <a href="?action=reset">Reiniciar joc</a>
    <a href="?action=exit">Acabar joc</a>
</div>

 <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/panel.view.php'  ?>

</body>
</html>