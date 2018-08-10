# PHP-forum
A simple forum based on PHP

Below i will list the steps that for creating the forum
  1. First we have to create a database(db). In this case i have used MySQL.
  2. Then we have to create the needed tables. For my forum the tables are: 
     - t_user(we are going to insert the users here, when the user create a registration)
     - categories(we will insert and list all of the forum categories here)
     - sub_categories (we will insert and list all of the forum subcategories here)
     - topics (we will insert and list all of the forum topics here)
  3. Once we are ready with the database we can start writing php.
  4. In order to display something from the database to the web we have to ensure that we have a connection to our db(db_connection.php)
  5. Then we can create our index.php file. We will use it to display the main page and to call different functions through it.
  6. Once we create the main headers of our webpage we can create the registration and the login page. In the index.php we should only 
  call the functions.
  7. We have to create separate files for the registration(registration.html,add_user.php) and login/logout(layout_manager.php,logout.php,
  validatelogin.php), but make sure that you will include those files in the index.php.
  8. In order to list all the categories, subcategories you have to use the functions in content_function.php.
  9. To list the topics use the function disp_topics from content_function.php and create a separate file topic.php(same like index.php),
  but instead of calling display_cat, call disp_topics.
  
  ... That's for now. I will add additional info when i finish the forum. I hope the information above is helpful.
