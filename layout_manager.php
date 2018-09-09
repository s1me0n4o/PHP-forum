<?php     
        
  function loginform() {
        echo "<form id='index-form' action='./forum/validatelogin.php' method='POST'>
              <h1 id = 'form-sing'>Sing Up</h1>
              <p class='usr'>Username:</p>
              <input type='text' name='username' id='username' placeholder='Username...'' />
              
              <p>Password:</p>
              <input type='password' name='password' id='password' placeholder='Password...''/>
              
              <input type='submit' value='Login' />
              <button type='button' onclick='location.href=\"./forum/registration.html\";'>Register</button>
            </form>";
          }
?>

<?php      
function logout()
    {
        echo ("<p class='greeting'>Wellcome ".$_SESSION['username']."!\nEnjoy!</p>
        <form action='./forum/logout.php' method ='GET' type='button' class='btn btn-primary' data-toggle='modal' data-target='.bd-example-modal-lg'>
        <input id='log-out-submit' type='submit' value='Logout' /></form>");
    }
