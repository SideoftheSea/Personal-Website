<?php
	define('TITLE', 'Edit Event');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	print '<h2>Edit Event</h2>';

	if(is_administrator()) {
		if(isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0) ) {

			$query = "SELECT * FROM events WHERE id={$_GET['id']}";
			if($r = mysqli_query($dbc, $query)) {
				$row = mysqli_fetch_array($r);

				print '<form action="edit-event.php" method="post" class="form--inline">
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

						<p><label for="email">Duration of Event:</label><input type="text" name="duration" size="2" value="' . $row['duration'] . '"><label for="email">days</label></p>

						<p><label for="email">Event Description:</label><input type="text" name="e_desc" size="40" value="' . $row['e_desc'] . '"></p>

						<p><label for="email">Priority Level:</label>
							<select name="priority">
								<option value="1">Low</option>
								<option value="2">Medium</option>
								<option value="3">High</option>
							</select>
						</p>
						<input type="hidden" name="id" value="' . $_GET['id'] . '">
						<p><input type="submit" name="submit" value="Edit Event" class="button--pill"></p>
					</form>';
			} else {
				print '<p class="text--error">ERROR:</p><p>Could not retrieve the data because:<br>' . mysqli_error($dbc) . '.</p>';
			}
		} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
			$problem = FALSE;
			if(!is_numeric($_POST['duration']) && empty($_POST['e_desc'])) {
				$problem = TRUE;
				print '<p class="text--error">ERROR:</p><p>Invalid or missing fields</p><br />';
				print '<form action="edit-event.php" method="post" class="form--inline">
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
							for($i=2021; $i<= 2025; $i++) {
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

					<p><input type="submit" name="submit" value="Add Event" class="button--pill"></p>
				</form>';
				include('templates/footer.html');
			}

			if(!$problem) {
				$month = $_POST['month'];
				$day = $_POST['day'];
				$year = $_POST['year'];
				$duration = $_POST['duration'];
				$e_desc = $_POST['e_desc'];
				$priority = $_POST['priority'];
				$query = "UPDATE events SET month = $month, day = $day, year = $year, duration = $duration, e_desc = '$e_desc', priority = $priority WHERE id={$_POST['id']}";

				if($result = mysqli_query($dbc, $query)) {
					print '<p class="text--success">Event edited</p>';
				} else {
					print '<p class="text--error">ERROR:</p><p>Could not update the data because:<br>' . $mysqli_error($dbc) . '</p>';
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