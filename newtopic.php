<?php
	include ('layout_manager.php');
    include ('content_function.php');
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
    </div>

    <div class="content">
        <?php
            if (isset($_SESSION['username'])) {
                echo "<form action='/forum/addnewtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'
                        method='POST'>
                        
                        <p>Title: </p>
                        <input type='text' id='topic' name='topic' size='100'>
                        
                        <p>Content:</p>
                        <textarea id='content' name='content'></textarea>
                        <br>
                        <input type='submit' value='add new post' />
                      </form>";
            } else{
                echo "<p> Please login first or 
                        <a href='/forum/registration.html'>click here</a> 
                        to register.
                      </p>";
            }
        ?>
    </div>
</body>
</html>
