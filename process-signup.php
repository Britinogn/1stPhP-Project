<?php
    if (empty($_POST["name"])) {
        die("Name is required");
    }

    if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("email is required");
    }

    if (strlen($_POST["password"] < 8)) {
        die("Password must contain at least 8 letter");
    }

    if (! preg_match("/[a-z]/i", $_POST["password"])) {
        die("Password must contain at least one letter");
    }

    if (! preg_match("/[0-9]/i", $_POST["password_confirmation"])) {
        die("Password must contain at least one number");
    }


    if ($_POST["password"] !== $_POST["password_confirmation"]){
        die("sorry,your password did not match");
    }

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


    $mysqli = require __DIR__ ."/database.php";

    $sql = "INSERT INTO users (name, email, password_hash)
    
    VALUES(?,?,?)";

    $stmt = $mysqli->stmt_init() ;
    
    if( !   $stmt->prepare($sql)){
        die("SQL error: . $mysqli->error");
    }

    $stmt->bind_param("sss" ,
                    $_POST["name"], 
                    $_POST["email"], 
                    $password_hash );

    
    try{
        $stmt->execute() ;

        header("Location: success.html");
        exit;

    }catch(Exception $e){
        if($mysqli->errno === 1062){
            die("Sorry, this email has already been taken");
        }else{
            die("SQL error:" . $e->getMessage());
        }
    }                

    
    // echo "Registered Successfully";


    // print_r($_POST);



    // var_dump($password_hash);










?>
