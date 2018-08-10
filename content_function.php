<?php 
	function display_cat() {
		include ('db_connection.php');

		$select = mysqli_query($connection, "select * from categories");

		 while ($row = mysqli_fetch_assoc($select)) {
		 	echo "<table class = 'cat-table'>";
		 	echo "<tr><td class = 'main-cat' colspan = '2'>".$row['dsc']."</td></tr>";
			display_sub_cat($row['id']);
			echo "</table>";
		 }
	};

	function display_sub_cat($parent_id) {
		include('db_connection.php');

		$select = mysqli_query($connection, "select sc.cat_id, sc.id, sc.subcat_title, sc.subcat_dsc 
									   from categories c 
									   		inner join sub_categories sc on c.id = sc.cat_id 
									   where ($parent_id = c.id) and ($parent_id = sc.cat_id)");

		echo "<tr><th width='90%'>Categories</th><th width='10%'>Topics</th></tr>";

		while ($row = mysqli_fetch_assoc($select)) {
			echo "<tr><td class='cat_title'>
					<a href='/forum/topic.php?cid=".$row['cat_id']."&scid=".$row['id']."'>".$row['subcat_title']."</br>";
			echo $row['subcat_dsc']."</a></td>";
			echo "<td class = 'num-topic'>".getnumtopics($parent_id, $row['id'])."</td>
				</tr>";
		}
	};

	function getnumtopics($cat_id, $subcat_id){
		include ('db_connection.php');

		$select = mysqli_query($connection, "select cat_id, subcat_id
											from topics 
											where ".$cat_id."=cat_id and ".$subcat_id." = subcat_id");
		
		//if (mysqli_num_rows($select) == 1){
		//	$a = mysqli_num_rows($select);	
			//return count($a);

			return mysqli_num_rows($select);
		//} else
		// echo 0;

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
			echo "<table class='topic-table'>";
			echo "<tr><th>Title</th><th>Posted By</th><th>Date Posted</th><th>Views</th><th>Replies</th></tr>";

			while ($row = mysqli_fetch_assoc($select)) {
				echo "<tr>
						<td><a href='/forum/readtopic.php?cid=".$cat_id."&scid=".$subcat_id."&tid=".$row['id']."'>".$row['title']."</a></td>
						<td>".$row['author']."</td><td>".$row['date_created']."</td><td>".$row['views']."</td><td>".$row['replies']."</td>
					  </tr>";
			}
			echo "</table>";
		}else {
			echo "<p>This category has no topics yet! <a href='/forum/newtopic.php?cid=".$cat_id."&scid=".$subcat_id."'>
					Feel free to add the first topic right now!</a></p>";
		};

	};
 ?>