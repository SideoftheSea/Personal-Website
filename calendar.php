<?php
	define('TITLE', 'Calendar');
	include('includes/calendar.php');
	include('includes/functions.php');
	include('templates/header.html');

	date_default_timezone_set('Asia/Taipei');
	$date = date('Y-m-d');
	$calendar = new Calendar($date);

	include('includes/mysqli_connect.php');

	$query = "SELECT * FROM events";
	if($r = mysqli_query($dbc, $query)) {
		while($row = mysqli_fetch_array($r)) {
			$color = '';
			switch($row['priority']) {
				case 1: 
					$color = 'blue';
					break;
				case 2: 
					$color = '';
					break;
				case 3: 
					$color = 'red';
					break;
				default:
					$color = 'green';
					break;
			}
			$date = $row['year'] . '-' . $row['month'] . '-' . $row['day'];
			$desc = $row['e_desc'];
			$duration = $row['duration'];
			$calendar->add_event($desc, $date, $duration, $color);
		}
	}


	print '<h2>Personal Calendar</h2>';

	print $calendar;

	if(is_staff() || is_administrator()) {
		print '<hr><form action="add-event.php" method="post" class="form--inline">
				<input type="submit" name="response" value="Create Event" class="button--pill">
				</form>';
	}
	if(is_administrator()) {
		print '	<form action="modify-event.php" method="post" class="form--inline">
				<input type="submit" name="response" value="Modify Event" class="button--pill">
				</form>';
	}

	include('templates/footer.html');
?>
