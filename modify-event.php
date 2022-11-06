<?php
	define('TITLE', 'Modify Event');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Modify Event</h2>';

	if(is_administrator()) {
		include('includes/mysqli_connect.php');
		$query = 'SELECT * FROM events ORDER BY id ASC';

		if($r = mysqli_query($dbc, $query)) {
			while($row = mysqli_fetch_array($r)) {
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
				print '<div><blockquote>' . $row['e_desc'] . '</blockquote><p><b>Date: ' . $date . '</b> | Priority: <i>' . $priority . '</i></p>';
				print "<p><a href=\"edit-event.php?id={$row['id']}\">Edit Event</a> | <a href=\"cancel-event.php?id={$row['id']}\">Cancel Event</a></p></div><hr>";
			}
			include('templates/footer.html');
		}
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
	}
?>