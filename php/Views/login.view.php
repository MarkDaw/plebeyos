<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body id="login">
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/error.view.php'  ?>

    <form method="post" action="">
        <label for="user">Username:
        <input type="text" id="user" name="user" required></label>
        <label for="password">Password:
        <input type="password" id="password" name="password" required></label>
        <button type="submit">Login</button>
    </form>
</body>
</html>