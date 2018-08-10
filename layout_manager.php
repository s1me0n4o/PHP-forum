<?php
    function loginform() {
        echo "<form action='/forum/validatelogin.php' method='POST'>
			  <p>Username:</p>
			  <input type='text' name='username' id='username' />
				<p>Password:</p>
				<input type='password' name='password' id='password'/>
				<input type='submit' value='Login' />
				<button type='button' onclick='location.href=\"/forum/registration.html\";'>Register</button>
            </form>";
          }

    function logout()
    {
        echo ("<p>Wellcome ".$_SESSION['username']."!\nLooking good today!</p>
        <form action = '/forum/logout.php' method ='GET'>
        <input type='submit' value='Logout' /></form>");
        # code...
    }