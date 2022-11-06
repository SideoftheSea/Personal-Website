<?php
	define('TITLE', 'Marketing - Remove Staff');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Remove Marketing Staff</h2>';

	if(is_administrator()) {
		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
			$query = "SELECT * FROM m_todo WHERE id={$_GET['id']}";
			if($result = mysqli_query($dbc, $query)) {
				$row = mysqli_fetch_array($result);

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

				print '';

				print '<form action="remove-task.php" method="post">
							<p>Are you sure you want to remove this task?</p>
							<div><b>' . $row['task'] . '</b><p>Due on: <i>' . $deadline . '</i><br>Posted on: <i>' . $date_entered . '</i><br><b>Status: ' . $status . '</b></p></div><br>
							<input type="hidden" name="id" value="' . $_GET['id'] . '">
							<p><input type="submit" name="submit" value="Remove Task"></p>
						</form>';
			} else {
				print '<p class="text--error">ERROR:</p>ERROR:</p><p>Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
			$query = "DELETE FROM m_todo WHERE id={$_POST['id']} LIMIT 1";
			$result = mysqli_query($dbc, $query);

			if(mysqli_affected_rows($dbc) == 1) {
				print '<p class="text--success">The task has been removed.</p>';
			} else {
				print '<p class="text--error">ERROR:</p><p>Could not remove the task because:<br>' . mysqli_error($dbc) . '.</p>';
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