<?php
	define('TITLE', 'Marketing Relations Projects');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	$query = "SELECT * FROM m_projects ORDER BY id DESC";

	if($r = mysqli_query($dbc, $query)) {
		while ($row = mysqli_fetch_array($r)) {
			$project = $row['project'];
			$deadline = $row['deadline'];
			$date = $row['date_entered'];
			$mquery = "SELECT id, name FROM m_roster WHERE id={$row['member_assigned']}";
			if($res = mysqli_query($dbc, $mquery)) {
				$mrow = mysqli_fetch_array($res);
				$member = $mrow['name'];
			}
			$status = $row['status'];

			switch($status) {
				case 1:
					$status = '<p class="text--success">Finished</p>';
					break;
				case 0:
					$status = '<p class="text--error">Not Finished</p>';
					break;
			}

			print '<div><b>' . $project . '</b><p>Posted on: <i>' . $date . '</i><br>Due on: <i>' . $deadline . '</i><br>Member Assigned: <i>' . $member . '</i><br><b>Status: ' . $status . '</b></p></div>';
		}
		if(is_staff() || is_administrator()) {
			print '<hr><form action="add-project.php" method="post" class="form--inline">
					<input type="submit" name="response" value="Add Project" class="button--pill">
					</form>';
		}
		if(is_administrator()) {
			print '	<form action="modify-project.php" method="post" class="form--inline">
					<input type="submit" name="response" value="Modify Project" class="button--pill">
					</form>';
		}
		include('templates/footer.html');
	}	
	else print mysqli_error($dbc);
?>