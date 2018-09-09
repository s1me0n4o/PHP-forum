<?php 
	function display_cat() {
		include ('db_connection.php');

		$select = mysqli_query($connection, "select * from categories");

		 while ($row = mysqli_fetch_assoc($select)) {
		 	echo "<table class = 'table table-hover table-dark'>";
		 	echo "<tr><td class = 'main-cat' colspan = '2'>".$row['dsc']."</td></tr>";
			display_sub_cat($row['id']);
			echo "</table>";
		 }
	};

	function display_sub_cat($parent_id) {
		include('db_connection.php');

		$select = mysqli_query($connection, "select sc.cat_id, sc.id, sc.subcat_title
									   from categories c 
									   		inner join sub_categories sc on c.id = sc.cat_id 
									   where ($parent_id = c.id) and ($parent_id = sc.cat_id)");

		echo "<tr><th class='sub-cat' width='90%'>Categories</th><th class='sub-cat' width='10%'>Topics</th></tr>";

		while ($row = mysqli_fetch_assoc($select)) {
			echo "<tr><td class='cat_title'>
					<a href='http://dekforum.gearhostpreview.com/forum/topic.php?cid=".$row['cat_id']."&scid=".$row['id']."'>".$row['subcat_title']."</br>";
			echo "<td class = 'cat_title'>".getnumtopics($parent_id, $row['id'])."</td>
				</tr>";
		}
	};

	function getnumtopics($cat_id, $subcat_id){
		include ('db_connection.php');

		$select = mysqli_query($connection, "select cat_id, subcat_id
											from topics 
											where ".$cat_id."=cat_id and ".$subcat_id." = subcat_id");
		
			return mysqli_num_rows($select);
	};

	function disp_topics($cat_id, $subcat_id) {
		include ('db_connection.php');

		$select = mysqli_query($connection, "select t.id, t.author, t.title, t.date_created, views, replies
											 from topics t
											 	inner join categories c on t.cat_id = c.id
											 	inner join sub_categories sc on c.id = sc.cat_id and sc.id = t.subcat_id
											 where $cat_id = t.cat_id and $subcat_id = t.subcat_id and $cat_id = c.id and $subcat_id = sc.id
											 order by t.id desc");

		if (mysqli_num_rows($select) != 0) {
			echo "<table class='table table-hover table-dark'>";
			echo "<tr class = 'main-cat'><th>Title</th><th>Posted By</th><th>Date Posted</th><th>Views</th><th>Replies</th></tr>";

			while ($row = mysqli_fetch_assoc($select)) {
				echo "<tr class='cat_title'>
						<td><a href='/forum/readtopic.php?cid=".$cat_id."&scid=".$subcat_id."&tid=".$row['id']."'>".$row['title']."</a></td>
						<td>".$row['author']."</td><td>".$row['date_created']."</td><td>".$row['views']."</td><td>".$row['replies']."</td>
					  </tr>";
			}
			echo "</table>";
		}else {
			echo "<p id='new-topic'><span>This category has no topics yet!</span> <a href='/forum/newtopic.php?cid=".$cat_id."&scid=".$subcat_id."'>
					Feel free to add the first topic right now!</a></p>";
		};
	};

	function disp_single_topic($cid, $scid, $tid){
		include('db_connection.php');

		$select = mysqli_query($connection, 
							"select t.cat_id, t.subcat_id, t.id, t.author, t.title, t.content, t.date_created 
							from topics t
								inner join categories c on c.id = t.cat_id
								inner join sub_categories sc on sc.id = t.subcat_id
							where $cid = c.id and $scid = sc.id and $tid = t.id");

		$row = mysqli_fetch_assoc($select);

		echo nl2br("<div class='content'>
					<h2 class='main-cat'>".$row['title']."</h2>
					<div class='sub-cat'><p>".$row['content']."</p></div>
						<p><span>Posted by: ".$row['author']."\n".$row['date_created']."</span></p>
					");

		 echo "<p class='reply-post'>All Replies(".count_replies($_GET['cid'],$_GET['scid'],$_GET['tid']).")  
               </p></div>";

	}

	function updviews($cid, $scid, $tid){
		include('db_connection.php');

		$update = mysqli_query($connection, "update topics 
											 set views = views + 1 
											 where cat_id = ".$cid." and subcat_id = ".$scid." and id = ".$tid."");
	}
 	
	function reply_link($cid, $scid, $tid){
		echo "<p><a id='reply' href='/forum/replys.php?cid=".$cid."&scid=".$scid."&tid=".$tid."'>Reply to this post!</a></p>";
	}

 	function reply_post($cid, $scid, $tid){
 		echo "
			 <div class='content'>
			    <form action='/forum/addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
			        <p>Comment:</p>
			        <textarea cols='40' rows='10' id='comment' name='comment'></textarea>
			        <input id='submit-reply' type='submit' value='Add Comment'>
			    </form>
			</div>";
 	}

 	function display_replies($cid, $scid, $tid){
 		include('db_connection.php');

 		$select = mysqli_query($connection, "select r.author, r.coment, r.date_created
 											 from replies r
 											 	inner join categories c on c.id = r.cat_id
 											 	inner join sub_categories sc on c.id = sc.cat_id
 											 	inner join topics t on t.subcat_id = sc.id
 											 where r.topic_id = $tid and c.id = $cid and sc.id = $scid and t.id = $tid
 											 order by r.id desc
 											 	");

 		if (mysqli_num_rows($select) != 0){
 			
 			echo "<div class='content'>
    			  	<table class='table table-sm'>";
					    while ($row = mysqli_fetch_assoc($select)){
					    echo nl2br("<tr>
					            		<th class='reply-post' width='15%'>Posted by: ".$row['author']."</th>
					            		<td class='reply-post'>".$row['coment']."\n <span>".$row['date_created']."\n\n</span></td>
					    			</tr>");
						} 
   			echo "</table></div>";
 		}
 	}

 	function count_replies($cid, $scid, $tid){
 		include('db_connection.php');
 		$select = mysqli_query($connection, "select cat_id, subcat_id, topic_id 
 											 from replies
 											 where cat_id = ".$cid." and subcat_id =".$scid." and topic_id = ".$tid."");

 		return mysqli_num_rows($select);
 	}

 ?>
