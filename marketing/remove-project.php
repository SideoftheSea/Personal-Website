<?php
	define('TITLE', 'Marketing - Remove Project');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Remove Marketing Project</h2>';

	if(is_administrator()) {
		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
			$query = "SELECT * FROM m_projects WHERE id={$_GET['id']}";
			if($result = mysqli_query($dbc, $query)) {
				$row = mysqli_fetch_array($result);

				$project = $row['project'];
				$deadline = $row['deadline'];
				$date_entered = $row['date_entered'];
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

				print '<form action="remove-project.php" method="post">
							<p>Are you sure you want to remove this project?</p>
							<div><b>' . $project . '</b><p>Posted on: <i>' . $date_entered . '</i><br>Due on: <i>' . $deadline . '</i><br>Member Assigned: <i>' . $member . '</i><br><b>Status: ' . $status . '</b></p></div><br>
							<input type="hidden" name="id" value="' . $_GET['id'] . '">
							<p><input type="submit" name="submit" value="Remove Task"></p>
						</form>';
			} else {
				print '<p class="text--error">ERROR:</p>ERROR:</p><p>Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
			$query = "DELETE FROM m_projects WHERE id={$_POST['id']} LIMIT 1";
			$result = mysqli_query($dbc, $query);

			if(mysqli_affected_rows($dbc) == 1) {
				print '<p class="text--success">The project has been removed.</p>';
			} else {
				print '<p class="text--error">ERROR:</p><p>Could not remove the project because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} else {
			print '<p class="text--error">ERROR:</p><p>This page has been accessed in error.</p>';
		}

		include('templates/footer.html');

		mysqli_close($dbc);
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
	}
?>