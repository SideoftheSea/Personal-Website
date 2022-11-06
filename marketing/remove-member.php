<?php
	define('TITLE', 'Marketing - Remove Staff');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Remove Marketing Staff</h2>';

	if(is_administrator()) {
		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
			$query = "SELECT * FROM m_roster WHERE id={$_GET['id']}";
			if($result = mysqli_query($dbc, $query)) {
				$row = mysqli_fetch_array($result);

				$projects = $row['projects'];
				switch($row['role']) {
					case 1:
						$role = 'Director of Marketing Relations';
						break;
					case 2:
						$role = 'Assistant Executive of Marketing Relations';
						break;
					case 3:
						$role = 'Marketing Strategies Manager';
						break;
					case 4:
						$role = 'Marketing Research Manager';
						break;
					case 5:
						$role = 'Marketing Strategies Staff';
						break;
					case 6:
						$role = 'Marketing Research Staff';
						break;
				}

				print '<form action="remove-member.php" method="post">
							<p>Are you sure you want to remove this member?</p>
							<div><b>' . $row['name'] . '</b><p style="color:purple;"><b>' . $role . '</b></p><p style="color:blue;"><i>' . $projects . ' finished projects</i></p></div><br>
							<input type="hidden" name="id" value="' . $_GET['id'] . '">
							<p><input type="submit" name="submit" value="Remove Member"></p>
						</form>';
			} else {
				print '<p class="text--error">ERROR:</p>ERROR:</p><p>Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
			$query = "DELETE FROM m_roster WHERE id={$_POST['id']} LIMIT 1";
			$result = mysqli_query($dbc, $query);

			if(mysqli_affected_rows($dbc) == 1) {
				print '<p class="text--success">The member has been removed.</p>';
			} else {
				print '<p class="text--error">ERROR:</p><p>Could not remove the member because:<br>' . mysqli_error($dbc) . '.</p>';
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