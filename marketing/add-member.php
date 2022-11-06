<?php
	define('TITLE', 'Add Marketing Staff');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Add Marketing Staff</h2>';

	if(is_staff() || is_administrator()) {
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['posted'])) {
			if(is_numeric($_POST['projects']) && !empty($_POST['name'])) {
				include('includes/mysqli_connect.php');

				$name = $_POST['name'];
				$position = $_POST['position'];
				$projects = $_POST['projects'];

				$query = "INSERT INTO m_roster (id, name, role, projects) VALUES (0, '$name', $position, $projects)";
				if(mysqli_query($dbc, $query)) {
					print '<p class="text--success">Member added!</p><br><a href="/marketing/roster.php">Back to Roster</a>';
				} else {
					print '<p class="text--error">ERROR:</p>Could not add the member because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
				}

				mysqli_close($dbc);
			} else {
				print '<p class="text--error">ERROR:</p>Invalid or missing fields';
			}
		} else {
			print '<form action="add-member.php" method="post" class="form--inline">
					<p><label for="email">Member Name:</label><input type="text" name="name" size="20"></p>
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
					<p><label for="email">Projects Finished:</label><input type="text" name="projects" size="2"><label for="email">projects</label></p>
					<input type="hidden" name="posted">
					<p><input type="submit" name="submit" value="Add Member" class="button--pill"></p>
				</form>'; 
				include('templates/footer.html');
		}
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
		exit();
	}
?>