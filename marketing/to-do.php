<?php
	define('TITLE', 'Marketing - To Do List');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Marketing Relations | To-Do List</h2>';

	$query = "SELECT * FROM m_todo ORDER BY id DESC";

	if($r = mysqli_query($dbc, $query)) {
		while ($row = mysqli_fetch_array($r)) {
			$task = $row['task'];
			$deadline = $row['deadline'];
			$date_entered = $row['date_entered'];
			$status = $row['status'];

			switch($status) {
				case 1:
					$status = '<p class="text--success">Finished</p>';
					break;
				case 0:
					$status = '<p class="text--error">Not Finished</p>';
					break;
			}

			print '<div><b>' . $row['task'] . '</b><p>Due on: <i>' . $deadline . '</i><br>Posted on: <i>' . $date_entered . '</i><br><b>Status: ' . $status . '</b></p></div>';
		}
		if(is_staff() || is_administrator()) {
			print '<hr><form action="add-task.php" method="post" class="form--inline">
					<input type="submit" name="response" value="Add Task" class="button--pill">
					</form>';
		}
		if(is_administrator()) {
			print '	<form action="modify-task.php" method="post" class="form--inline">
					<input type="submit" name="response" value="Modify Task" class="button--pill">
					</form>';
		}
		include('templates/footer.html');
	}	
?>