<?php
	define('TITLE', 'Marketing - Add Task');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Add Marketing Task</h2>';

	if(is_staff() || is_administrator()) {
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['posted'])) {
			if(!empty($_POST['task'])) {
				include('includes/mysqli_connect.php');


				$task = $_POST['task'];
				$deadline = $_POST['month'] . ' ' . $_POST['day'] . ', ' . $_POST['year'];
				date_default_timezone_set('Asia/Taipei');
				$date_entered = date('F j, Y');

				$query = "INSERT INTO m_todo (id, task, deadline, date_entered, status) VALUES (0, '$task', '$deadline', '$date_entered', 0)";
				if(mysqli_query($dbc, $query)) {
					print '<p class="text--success">Task added!</p><br><a href="/marketing/to-do.php">Back to To-Do List</a>';
				} else {
					print '<p class="text--error">ERROR:</p>Could not add the task because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
				}

				mysqli_close($dbc);
			} else {
				print '<p class="text--error">ERROR:</p>Invalid or missing fields';
				print '<form action="add-task.php" method="post" class="form--inline">
						<p><label for="email">Task:</label><input type="text" name="task" size="40"></p>
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
						<input type="hidden" name="posted">
						<p><input type="submit" name="submit" value="Add Task" class="button--pill"></p>
					</form>'; 
					include('templates/footer.html');
			}
		} else {
			print '<form action="add-task.php" method="post" class="form--inline">
					<p><label for="email">Task:</label><input type="text" name="task" size="40"></p>
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
					<input type="hidden" name="posted">
					<p><input type="submit" name="submit" value="Add Task" class="button--pill"></p>
				</form>'; 
				include('templates/footer.html');
		}
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
		exit();
	}
?>