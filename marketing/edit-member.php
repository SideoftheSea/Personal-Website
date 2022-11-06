<?php
	define('TITLE', 'Edit Marketing Staff');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Edit Marketing Staff</h2>';

	if(is_administrator()) {
		if(isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0) ) {

			$query = "SELECT * FROM m_roster WHERE id={$_GET['id']}";
			if($r = mysqli_query($dbc, $query)) {
				$row = mysqli_fetch_array($r);

				print '<form action="edit-member.php" method="post" class="form--inline">
						<p><label for="email">Member Name:</label><input type="text" name="name" size="20" value="' . $row['name'] . '"></p>
						<p><label for="email">Position:</label>
							<select name="position">
								<option value="1">Director of Marketing Relations</option>
								<option value="2">Assistant Executive of Marketing Relations</option>
								<option value="3">Marketing Strategies Manager</option>
								<option value="4">Marketing Research Manager</option>
								<option value="5">Marketing Strategies Staff</option>
								<option value="6">Marketing Research Staff</option>
							</select>
						</p>
						<p><label for="email">Projects Finished:</label><input type="text" name="projects" size="2" value="' . $row['projects'] . '"><label for="email">projects</label></p>
						<input type="hidden" name="id" value="' . $_GET['id'] . '">
						<p><input type="submit" name="submit" value="Edit Member" class="button--pill"></p>
					</form>';
			} else {
				print '<p class="text--error">ERROR:</p><p>Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
			$problem = FALSE;
			$name = '';
			if(!is_numeric($_POST['projects']) || empty($_POST['name'])) {
				$problem = TRUE;
				print '<p class="text--error">ERROR:</p><p>Invalid or missing fields</p><br />';
				print '<form action="edit-member.php" method="post" class="form--inline">
						<p><label for="email">Member Name:</label><input type="text" name="name" size="20" value="' . $_POST['name'] . '"></p>
						<p><label for="email">Position:</label>
							<select name="position">
								<option value="1">Director of Marketing Relations</option>
								<option value="2">Assistant Executive of Marketing Relations</option>
								<option value="3">Marketing Strategies Manager</option>
								<option value="4">Marketing Research Manager</option>
								<option value="5">Marketing Strategies Staff</option>
								<option value="6">Marketing Research Staff</option>
							</select>
						</p>
						<p><label for="email">Projects Finished:</label><input type="text" name="projects" size="2" value="' . $_POST['projects'] . '"><label for="email">projects</label></p>
						<p><input type="submit" name="submit" value="Edit Member" class="button--pill"></p>
					</form>';
				include('templates/footer.html');
				exit();
			}

			if(!$problem) {
				$name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
				$position = $_POST['position'];
				$projects = $_POST['projects'];
				$query = "UPDATE m_roster SET name = '$name', role = $position, projects = $projects WHERE id={$_POST['id']}";

				if($result = mysqli_query($dbc, $query)) {
					print '<p class="text--success">Member edited</p><br><a href="/marketing/roster.php">Back to Roster</a>';
				} else {
					print '<p class="text--error">ERROR:</p><p>Could not update the data because:<br>' . mysqli_error($dbc) . '</p>';
				}
			}
		} else {
			print '<p class="text--error">ERROR:</p><p>This page has been accessed in error.</p>';
		}

		mysqli_close($dbc);

		include('templates/footer.html');
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
	}
?>