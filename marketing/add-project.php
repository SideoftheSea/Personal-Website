<?php
	define('TITLE', 'Marketing - Add Project');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Add Marketing Project</h2>';

	if(is_staff() || is_administrator()) {
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['posted'])) {
			if(!empty($_POST['project'])) {
				include('includes/mysqli_connect.php');

				$project = $_POST['project'];
				$deadline = $_POST['month'] . ' ' . $_POST['day'] . ', ' . $_POST['year'];		
				date_default_timezone_set('Asia/Taipei');
				$date_entered = date('F j, Y');
				$member = $_POST['member'];

				$query = "INSERT INTO m_projects (id, project, deadline, date_entered, member_assigned, status) VALUES (0, '$project', '$deadline', '$date_entered', $member, 0)";
				if(mysqli_query($dbc, $query)) {
					print '<p class="text--success">Project added!</p><br><a href="/marketing/projects.php">Back to Projects</a>';
				} else {
					print '<p class="text--error">ERROR:</p>Could not add the project because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
				}

				mysqli_close($dbc);
			} else {
				print '<p class="text--error">ERROR:</p>Invalid or missing fields';
				print '<form action="add-project.php" method="post" class="form--inline">
						<p><label for="email">Project:</label><input type="text" name="project" size="40"></p>
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
						<input type="hidden" name="posted">
						<p><input type="submit" name="submit" value="Add Project" class="button--pill"></p>
					</form>'; 
					include('templates/footer.html');
					exit();
			}
		} else {
			print '<form action="add-project.php" method="post" class="form--inline">
					<p><label for="email">Project:</label><input type="text" name="project" size="40"></p>
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
						<select name="year">\n'; 
					?>
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
						include('includes/mysqli_connect.php');
						$tquery = "SELECT id, name FROM m_roster";
						if($r = mysqli_query($dbc, $tquery)) {
							while($row = mysqli_fetch_array($r)) {
								print '<option value="' . $row['id'] . '">' . $row['name'] . '</option>\n';
							}
						} else {
							print mysqli_error($dbc);
						}
					?>
					<?php
						print '</select>
						</p>
						<input type="hidden" name="posted">
						<p><input type="submit" name="submit" value="Add Project" class="button--pill"></p>
					</form>'; 
			include('templates/footer.html');
			exit();
		}
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
		exit();
	}
?>