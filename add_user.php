<?php

    $msg = "";
    include ('db_connection.php');

    $usr = $_POST['username'];
    $psw = $_POST['password'];

    
    if ($usr == "" || $psw == ""){
        $msg = "Emty User or Password!";
    }
    else{
        $insert = mysqli_query($connection, "insert into t_user (`user`, `pass`)
                                             values('".$usr."','".$psw."');");
    }

    if ($insert){
        header("Location: ./index.php?status=reg_success");
    }
    else {
        $msg = "Emty User or Password! Please try again!"
    }
