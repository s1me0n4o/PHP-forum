
<?php
    session_start();

    include ('db_connection.php');

    $usr = $_POST['username'];
    $psw = $_POST['password'];

    $result = mysqli_query($connection, "select user, pass from t_user where user ='".$usr."' and pass ='".$psw."'");

    if (mysqli_num_rows($result) != 0){
        $_SESSION['username'] = $usr;
        header("Location:".$_SERVER['HTTP_REFERER']);
    } else {
        header("Location:".$_SERVER['HTTP_REFERER']."?status=login_fail");
    }
?>