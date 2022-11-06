<?php
	define('TITLE', 'Marketing - Edit Project');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Edit Marketing Project</h2>';

	if(is_administrator()) {
		if(isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0) ) {

			$query = "SELECT * FROM m_projects WHERE id={$_GET['id']}";
			if($r = mysqli_query($dbc, $query)) {
				$row = mysqli_fetch_array($r);
				$project = $row['project'];

				print '<form action="edit-project.php" method="post" class="form--inline">
						<p><label for="email">Project:</label><input type="text" name="project" size="40" value="' . $project. '"></p>
						<p><label for="email">Due Date:</label>
						<select name="month">
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
						<select name="day">\n'; 
						?>
							<?php 
								for($i=1; $i<=31; $i++) {
									print '<option value="' . $i . '">' . $i . '</option>\n';
								}
							?>
							<?php
							print '</select>
							<select name="year">\n'; ?>
							<?php
								for($i=2022; $i<= 2025; $i++) {
									print '<option value="' . $i . '">' . $i . '</option>\n';
								}
							?>
							<?php
								print '</select>
										</p>
										<p><label for="email">Assigned Member:</label>
										<select name="member">\n';
							?>
							<?php
								$tquery = "SELECT id, name FROM m_roster";
								$r = mysqli_query($dbc, $tquery);
								while($row = mysqli_fetch_array($r)) {
									print '<option value="' . $row['id'] . '">' . $row['name'] . '</option>\n';
								}
							?>
							<?php
							print '</select>
						</p>
						<p><label for="email">Status:</label>
						<select name="status">
							<option value="0">Not Finished</option>
							<option value="1">Finished</option>
						</select>
						<input type="hidden" name="id" value="' . $_GET['id'] . '">
						<p><input type="submit" name="submit" value="Edit Project" class="button--pill"></p>
					</form>';
			} else {
				print '<p class="text--error">ERROR:</p><p>Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
			$problem = FALSE;
			if(empty($_POST['project'])) {
				$problem = TRUE;
				print '<p class="text--error">ERROR:</p><p>Invalid or missing fields</p><br />';
				print '<form action="edit-project.php" method="post" class="form--inline">
						<p><label for="email">Project:</label><input type="text" name="project" size="40" value="' . $_POST['project'] . '"></p>
						<p><label for="email">Due Date:</label>
						<select name="month">
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
						<select name="day">\n'; 
						?>
							<?php 
								for($i=1; $i<=31; $i++) {
									print '<option value="' . $i . '">' . $i . '</option>\n';
								}
							?>
							<?php
							print '</select>
							<select name="year">\n'; ?>
							<?php
								for($i=2022; $i<= 2025; $i++) {
									print '<option value="' . $i . '">' . $i . '</option>\n';
								}
							?>
							<?php
								print '</select>
										</p>
										<p><label for="email">Assigned Member:</label>
										<select name="member">\n';
							?>
							<?php
								$tquery = "SELECT id, name FROM m_roster";
								$r = mysqli_query($dbc, $tquery);
								while($row = mysqli_fetch_array($r)) {
									print '<option value="' . $row['id'] . '">' . $row['name'] . '</option>\n';
								}
							?>
							<?php
							print '</select>
						</p>
						<p><label for="email">Status:</label>
						<select name="status">
							<option value="0">Not Finished</option>
							<option value="1">Finished</option>
						</select>
						<input type="hidden" name="posted">
						<p><input type="submit" name="submit" value="Edit Project" class="button--pill"></p>
					</form>';
				include('templates/footer.html');
				exit();
			}

			if(!$problem) {
				$project = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['project'])));
				$deadline = $_POST['month'] . ' ' . $_POST['day'] . ', ' . $_POST['year'];
				$status = $_POST['status'];
				$member = $_POST['member'];
				$query = "UPDATE m_projects SET project = '$project', deadline = '$deadline', status = $status, member_assigned = $member WHERE id={$_POST['id']}";

				if($result = mysqli_query($dbc, $query)) {
					print '<p class="text--success">Project edited</p><br><a href="/marketing/projects.php">Back to Projects List</a>';
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