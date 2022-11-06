<?php
	define('TITLE', 'Cancel Event');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Cancel Event</h2>';

	if(is_administrator()) {
		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
			$query = "SELECT * FROM events WHERE id={$_GET['id']}";
			if($result = mysqli_query($dbc, $query)) {
				$row = mysqli_fetch_array($result);

				$date = $row['month'] . '-' . $row['day'] . '-' . $row['year'];
				switch($row['priority']) {
					case 1:
						$priority = 'Low';
						break;
					case 2:
						$priority = 'Medium';
						break;
					case 3:
						$priority = 'High';
						break;
				}

				print '<form action="cancel-event.php" method="post">
							<p>Are you sure you want to cancel this meeting?</p>
							<div><blockquote>' . $row['e_desc'] . '</blockquote><p><b>Date: ' . $date . '</b> | Priority: <i>' . $priority . '</i></p></div><br><input type="hidden" name="id" value="' . $_GET['id'] . '"><p><input type="submit" name="submit" value="Cancel Meeting"></p>
						</form>';
			} else {
				print '<p class="text--error">ERROR:</p>ERROR:</p><p>Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
			$query = "DELETE FROM events WHERE id={$_POST['id']} LIMIT 1";
			$result = mysqli_query($dbc, $query);

			if(mysqli_affected_rows($dbc) == 1) {
				print '<p class="text--success">The event has been cancelled.</p>';
			} else {
				print '<p class="text--error">ERROR:</p><p>Could not cancel the event because:<br>' . mysqli_error($dbc) . '.</p>';
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