<?php
	include ('layout_manager.php');
    include ('content_function.php');
    updviews($_GET['cid'],$_GET['scid'],$_GET['tid']);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum</title>
</head>
<body>
    <div>
        <h1><a href="/forum">Trying to create a forum</a></h1>
    </div>

      <?php
            session_start();
            if(isset($_SESSION['username'])){
                logout();
                //logout function
            }  else{
                    if (isset($_GET['status'])){

                            if($_GET['status'] == 'reg_success') {
                                echo "<h1 style = 'color:green'>You have been registrated successfully<h1>";
                            }
                            else if ($_GET['status']=='login_fail'){
                                echo "<h1 style ='color:red;'>Invalid username or password!</h1>";
                            }
                    }
                    loginform();
                }
        ?>

    <div>
        <p>Wellcome to the world of Monko</p>

        <?php 
            reply_link($_GET['cid'], $_GET['scid'],$_GET['tid']);
         ?>
    </div>

        <?php 
            disp_single_topic($_GET['cid'], $_GET['scid'],$_GET['tid']);

            echo "<div class='content'>
                    <p> All Replies(".count_replies($_GET['cid'],$_GET['scid'],$_GET['tid']).")  
                    </p>
                  </div>";
            display_replies($_GET['cid'],$_GET['scid'],$_GET['tid']);
         ?>

</body>
</html>
