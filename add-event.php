<?php
	define('TITLE', 'Add Event');
	include('includes/calendar.php');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Add Event</h2>';

	if(is_staff() || is_administrator()) {
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['posted'])) {
			if(is_numeric($_POST['duration']) && !empty($_POST['e_desc'])) {
				include('includes/mysqli_connect.php');

				$month = $_POST['month'];
				$day = $_POST['day'];
				$year = $_POST['year'];
				$duration = $_POST['duration'];
				$e_desc = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['e_desc'])));
				$priority = $_POST['priority'];

				$query = "INSERT INTO events (id, month, day, year, duration, e_desc, priority) VALUES (0, '$month', '$day', '$year', '$duration', '$e_desc', '$priority')";
				if(mysqli_query($dbc, $query)) {
					print '<p class="text--success">Event added!</p>';
				} else {
					print '<p class="text--error">ERROR:</p>Could not add the event because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
				}

				mysqli_close($dbc);
			} else {
				print '<p class="text--error">ERROR:</p><p>Invalid or missing fields</p><br />';
				print '<form action="add-event.php" method="post" class="form--inline">
					<p><label for="email">Date of Event:</label>
					<select name="month">
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
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

					<p><label for="email">Duration of Event:</label><input type="text" name="duration" size="2"><label for="email">days</label></p>

					<p><label for="email">Event Description:</label><input type="text" name="e_desc" size="40"></p>

					<p><label for="email">Priority Level:</label>
						<select name="priority">
							<option value="1">Low</option>
							<option value="2">Medium</option>
							<option value="3">High</option>
						</select>
					</p>
					<input type="hidden" name="posted">
					<p><input type="submit" name="submit" value="Add Event" class="button--pill"></p>
				</form>';
				include('templates/footer.html');
			}
		} else {
			print '<form action="add-event.php" method="post" class="form--inline">
					<p><label for="email">Date of Event:</label>
					<select name="month">
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
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

					<p><label for="email">Duration of Event:</label><input type="text" name="duration" size="2"><label for="email">days</label></p>

					<p><label for="email">Event Description:</label><input type="text" name="e_desc" size="40"></p>

					<p><label for="email">Priority Level:</label>
						<select name="priority">
							<option value="1">Low</option>
							<option value="2">Medium</option>
							<option value="3">High</option>
						</select>
					</p>
					<input type="hidden" name="posted">
					<p><input type="submit" name="submit" value="Add Event" class="button--pill"></p>
				</form>';
				include('templates/footer.html');
		} 
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
	}
?>