<?php
	define('TITLE', 'Marketing - Modify Task');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Modify Marketing Task</h2>';

	if(is_administrator()) {
		include('includes/mysqli_connect.php');
		$query = 'SELECT * FROM m_todo ORDER BY deadline ASC';

		if($r = mysqli_query($dbc, $query)) {
			while($row = mysqli_fetch_array($r)) {
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
				print "<p><a href=\"edit-task.php?id={$row['id']}\">Edit Task</a> | <a href=\"remove-task.php?id={$row['id']}\">Remove Task</a></p></div><hr>";
			}
			include('templates/footer.html');
		}
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
	}
?>