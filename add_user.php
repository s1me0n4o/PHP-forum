<?php

    include ('db_connection.php');

    $usr = $_POST['username'];
    $psw = $_POST['password'];

    $insert = mysqli_query($connection, "insert into t_user (`user`, `pass`)
                                            values('".$usr."','".$psw."');");

    if ($insert){
        header("Location: /forum/index.php?status=reg_success");
    }