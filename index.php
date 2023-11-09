<?php 

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require  __DIR__  ."/database.php";

    $sql = "SELECT * FROM users
            where id = {$_SESSION["user_id"]}";

            $result = $mysqli->query($sql);

            $user = $result->fetch_assoc();

}



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>

    <?php if(isset($user)): ?>

        <p>Hello ,<?= htmlspecialchars($user["name"])?></p>

        <p>Your email address is <?= htmlspecialchars($user["email"])?></p>

        <p>you are Logged In</p>
        <p><a href="logout.php">Log Out</a></p> 

        <?php else: ?>

        <p><a href="login.php">Login</a>   OR <br> <a href="signup.html">Sign Up</a></p>    

        <?php endif ?>
</body>
</html>
