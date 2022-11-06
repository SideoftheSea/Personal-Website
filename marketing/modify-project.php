<?php
	define('TITLE', 'Marketing - Modify Project');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Modify Marketing Project</h2>';

	if(is_administrator()) {
		include('includes/mysqli_connect.php');
		$query = 'SELECT * FROM m_projects ORDER BY deadline ASC';

		if($r = mysqli_query($dbc, $query)) {
			while($row = mysqli_fetch_array($r)) {
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
				print "<p><a href=\"edit-project.php?id={$row['id']}\">Edit Project</a> | <a href=\"remove-project.php?id={$row['id']}\">Remove Project</a></p></div><hr>";
			}
			include('templates/footer.html');
		}
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
	}
?>