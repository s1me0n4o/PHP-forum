<?php 
	session_start();

	include('db_connection.php');

	$comment = nl2br(addslashes($_POST['comment']));
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
	$tid = $_GET['tid'];

	$insert = mysqli_query($connection, "insert into replies(cat_id, subcat_id, topic_id, author, coment, date_created)
										 values(".$cid.", ".$scid.", ".$tid.", '".$_SESSION['username']."', '".$comment."', now())
						   				");

	if ($insert){
		header("Location: ./readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."");
	}
 ?>
