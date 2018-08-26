<?php 

	session_start();

	include('db_connection.php');

	$topic = addslashes($_POST['topic']);
	$content = nl2br(addslashes($_POST['content']));
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];

	$insert = mysqli_query($connection, 
		"insert into `topics`(`cat_id`, `subcat_id`, `author`, `title`, `content`, `views`, `date_created`)
		 values(".$cid.", ".$scid.", '".$_SESSION['username']."', '".$topic."', '".$content."', 0, NOW())");

	if($insert){
		header("Location: /forum/topic.php?cid=".$cid."&scid=".$scid."");
	}