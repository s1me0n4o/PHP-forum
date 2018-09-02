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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <header class=head-index>
        <h1>
            <a href="/forum">
                <ul class="fly-text hid">
                    <li>D</li>
                    <li>E</li>
                    <li>K</li>
                    <li>A</li>
                    <li>R</li>
                    <li>O</li>
                    <li>N</li>
                    <li> </li>
                    <li>F</li>
                    <li>O</li>
                    <li>R</li>
                    <li>U</li>
                    <li>M</li>
                </ul>
            </a>
        </h1>
    


<?php
        session_start();
        if(isset($_SESSION['username'])){
            logout();
        }  else{
                if (isset($_GET['status'])){

                        if($_GET['status'] == 'reg_success') {
                            echo "<h1 style = 'color:green'>You have been registrated successfully<h1>";
                        }
                        else if ($_GET['status']=='login_fail'){
                            echo "<h1 style ='color:red;'>Invalid username or password!</h1>";
                        }
                }
?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Sing In</button>

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
<?php  
                        loginform();
            }
?>
                    </div>
                  </div>
                </div>

                  
    <div class="page-title">
        <p>Wellcome to Simeon's World</p>
    </div>

    </header>
   


    <div class="content">
           
    </div>

        <?php 
            disp_single_topic($_GET['cid'], $_GET['scid'],$_GET['tid']);
 
            reply_link($_GET['cid'], $_GET['scid'],$_GET['tid']);
           
            display_replies($_GET['cid'],$_GET['scid'],$_GET['tid']);
         ?>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $('#ModalBtn').on('shown.bs.modal', function () {
        $('#orangeForm-name').trigger('focus')
        });

       $(function(){
           setTimeout(function(){
               $('.fly-text').removeClass('hid');
           },500);
        })();
    </script>
</body>
</html>