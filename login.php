<?php 
    $is_invalid = false;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require __DIR__ . "/database.php";

        $sql= sprintf( "SELECT * FROM users

                    WHERE email = '%s'",

                    $mysqli->real_escape_string($_POST["email"]));

                    $result = $mysqli->query($sql);

                    $user = $result->fetch_assoc();
    
        if($user){
            if(password_verify($_POST["password"], $user["password_hash"])){
                
                
                session_start();

                session_regenerate_id();



                $_SESSION["user_id"] = $user["id"];
                header("Location: index.php");
                exit;
            }
        }

        $is_invalid = true;

    }

?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    
    <style>
        
        h2{
            padding-top: 50px;
        }

        .login-btn:hover{
            background-color: black;
            color: white;
        }

        form{
            padding-top: 50px;
        }
    </style>
    
    
    </head>
    <body>
        <h2>Login Here</h2>

        <?php 
            if($is_invalid) : ?>
            <em>Your Login Is Invalid </em>
        <?php endif; ?>

    <form  class="form" method="post">
        <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= htmlspecialchars($_POST["email"]??"")?>"> <br>
        <input type="password" name="password" id="password"  placeholder="Enter your password" > 

        <button class="login-btn">Login Here</button>


        <p class="signup"> Don't have an account? <br>
            <a href="signup.html"> Register Here</a>
        </p>

        <p class="socials"> Login with:</p>

        <div class="icons">
            <a href="https://facebook.com"><ion-icon name="logo-facebook"></ion-icon>  </a>
            <a href="https://instagram.com"> <ion-icon name="logo-instagram"> </ion-icon>  </a>
            <a href="https://twitter.com"> <ion-icon name="logo-twitter"> </ion-icon>  </a>
            <a href="https://tiktok.com"> <ion-icon name="logo-tiktok"> </ion-icon>  </a>
        </div>

    </form>

    </body>
    </html>


